<script setup lang="ts">

import {useI18n, useSnackbarStore} from "#imports";

definePageMeta({
  layout: 'blank'
})

const localePath = useLocalePath()
const {genericRequiredRule, emailRequiredRules} = useValidationRules()
const client = useSanctumClient()
const snackbarStore = useSnackbarStore()
const {t} = useI18n()

const formValidity = ref(null)
const step = ref(1)
const email = ref('')
const verificationCode = ref('')
const password = ref('')
const confirmPassword = ref('')

const loading = ref(false)

const title = computed(() => {
  let title = ""
  if (step.value === 1) title = t('app.forgot_password.send.title')
  if (step.value === 2) title = t('app.forgot_password.verify.title')
  if (step.value === 3) title = t('app.forgot_password.update.title')

  return title
})

const subtitle = computed(() => {
  let subtitle = ""
  if (step.value === 1) subtitle = t('app.forgot_password.send.subtitle')
  if (step.value === 2) subtitle = t('app.forgot_password.verify.subtitle')
  if (step.value === 3) subtitle = t('app.forgot_password.update.subtitle')

  return subtitle
})

async function sendVerificationCode() {
  if (formValidity.value !== true) return

  loading.value = true
  await client('/auth/send-verification-code', {method: 'POST', body: {email: email.value}})
  loading.value = false

  snackbarStore.displaySuccessMessage(t('app.forgot_password.notify.enter_code'))

  step.value = 2
}

async function verifyCode() {
  if (formValidity.value !== true) return

  loading.value = true
  let error = false

  const payload = {code: verificationCode.value, email: email.value}
  await client('/auth/verify-code', {method: 'POST', body: payload}).catch(() => {
    error = true
  })
  loading.value = false

  if (error) {
    return snackbarStore.displayErrorMessage(t('app.forgot_password.notify.unable_to_verify'))
  }

  step.value = 3
}

async function updatePassword() {
  if (formValidity.value !== true) return

  loading.value = true
  let error = false

  const payload = {email: email.value, password: password.value, password_confirmation: confirmPassword.value}
  await client('/auth/update-password', {method: 'POST', body: payload}).catch(() => {
    error = true
  })
  loading.value = false

  if (error) {
    return snackbarStore.displayErrorMessage(t('app.forgot_password.notify.unable_to_update'))
  }


  useRouter().push(localePath('/'))
}

</script>

<template>
  <VCard class="container" tile color="#f8f9fb" height="100vh" :loading="loading">
    <div class="d-flex justify-end mr-6">
      <LocaleSwitcher />
    </div>
    <VRow class="fill-height">
      <VCol cols="12" class="d-flex flex-column justify-center align-center">
        <VCard color="transparent" elevation="0" tile max-width="400">

          <div class="form-login-container text-center">

            <VImg src="/images/bookisia/bookisia-logo.svg" alt="logo"/>

            <h2 class="mt-8 mb-2 font-weight-bold black--text sign-in-text">
              {{title}}
            </h2>
            <p class="black--text mb-8">
              {{subtitle}}
            </p>


            <VForm v-if="step === 1" v-model="formValidity" validate-on="lazy submit" @submit.prevent="sendVerificationCode">
              <VTextField
                  v-model="email"
                  type="email"
                  :label="$t('app.signup.left.form.email_address')"
                  outlined
                  density="compact"
                  :rules="emailRequiredRules($t('app.forms.person.validations.email_required'))"
              />

              <VBtn
                  block
                  color="primary"
                  class="my-8 text-capitalize font-weight-bold"
                  :loading="loading"
                  :text="$t('app.dictionary.send')"
                  type="submit"
              />
            </VForm>

            <VForm v-if="step === 2" v-model="formValidity" validate-on="lazy submit" @submit.prevent="verifyCode">
              <VTextField
                  v-model="verificationCode"
                  type="text"
                  :label="$t('app.forgot_password.verify.title')"
                  outlined
                  density="compact"
                  :rules="genericRequiredRule($t('app.forgot_password.forms.validations.verification_code'))"
              />

              <VBtn
                  block
                  color="primary"
                  class="my-8 text-capitalize font-weight-bold"
                  :loading="loading"
                  :text="$t('app.dictionary.send')"
                  type="submit"
              />
            </VForm>

            <VForm v-if="step === 3" v-model="formValidity" validate-on="lazy submit" @submit.prevent="updatePassword">
              <VTextField
                  v-model="password"
                  type="text"
                  :label="$t('app.forgot_password.forms.new_password')"
                  outlined
                  density="compact"
                  :rules="genericRequiredRule($t('app.forgot_password.forms.validations.new_password'))"
              />
              <VTextField
                  v-model="confirmPassword"
                  type="text"
                  :label="$t('app.forgot_password.confirm_password')"
                  outlined
                  density="compact"
                  :rules="genericRequiredRule($t('app.forgot_password.forms.validations.confirm_password'))"
              />

              <VBtn
                  block
                  color="primary"
                  class="my-8 text-capitalize font-weight-bold"
                  :loading="loading"
                  :text="$t('app.dictionary.send')"
                  type="submit"
              />
            </VForm>

            <p class="white--text">
              {{ $t("app.signup.left.existing_account_question") }}
              <NuxtLink class="text-blue-lighten-1" :to="localePath('/')">{{ $t("app.signup.left.sign_in") }}</NuxtLink>
            </p>

          </div>
        </VCard>
      </VCol>
    </VRow>
  </VCard>
</template>

<style scoped>
#wrapper {
  background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.3)),  url("../../public/images/forgot-password.jpg") no-repeat;
  background-size: cover;
}

.container {
  position: relative;
  overflow: hidden; /* Keeps background inside bounds */
}

.container::before {
  content: "";
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background-image: url("../../public/images/forgot-password.jpg");
  background-size: cover;
  opacity: 0.7; /* Adjust your transparency here */
  z-index: -1;
}
</style>