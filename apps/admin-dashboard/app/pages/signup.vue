<script setup lang="ts">

import type {User} from "@stratosphere/core-layer/types";

definePageMeta({
  layout: 'blank'
})

const localePath = useLocalePath()
const {genericRequiredRule, emailRequiredRules, registrationPasswordRules} = useValidationRules()
const client = useSanctumClient()

const formValidity = ref(null)
const showPassword = ref(false)
const user = ref<User>({
  first_name: '',
  last_name: '',
  email: '',
  password: '',
  type: 'staff'
})

const loading = ref(false)
const token = ref()
const options = {
  theme: 'light'
} as Turnstile.RenderParameters

const teamFeatures = $tm("app.signup.right.features")

async function signup() {
  if (formValidity.value !== true || !token.value) return

  loading.value = true
  let error = false
  await client('/auth/signup', {method: 'POST', body: {...user.value}}).catch(() => {
    error = true
  }) as User
  loading.value = false

  if (error) {
    throw Error('Registration error')
  }

  navigateTo('/')
}

</script>

<template>
  <VCard tile color="#f8f9fb" height="100vh" :loading="loading">
    <VRow class="fill-height">
      <VCol cols="12" md="6" class="d-flex flex-column justify-center align-center align-md-end pr-md-16">
        <VCard color="transparent" elevation="0" tile max-width="400">

          <div class="form-login-container text-center">

            <VImg src="/images/logo.svg" alt="logo"/>

            <p class="mt-8 mb-2 font-weight-bold black--text sign-in-text">
              {{ $t("app.signup.left.title") }}
            </p>
            <p class="black--text mb-8">{{ $t("app.signup.left.subtitle") }}</p>


            <VForm v-model="formValidity" validate-on="blur lazy" @submit.prevent="signup">
              <VTextField
                  v-model="user.first_name"
                  type="text"
                  :label="$t('app.signup.left.form.firstname')"
                  outlined
                  density="compact"
                  :rules="genericRequiredRule($t('app.forms.person.validations.first_name_required'))"
              />

              <VTextField
                  v-model="user.last_name"
                  type="text"
                  :label="$t('app.signup.left.form.lastname')"
                  outlined
                  density="compact"
                  :rules="genericRequiredRule($t('app.forms.person.validations.last_name_required'))"

              />

              <VTextField
                  v-model="user.email"
                  type="email"
                  :label="$t('app.signup.left.form.email_address')"
                  outlined
                  density="compact"
                  :rules="emailRequiredRules($t('app.forms.person.validations.email_required'))"
              />

              <VTextField
                  v-model="user.password"
                  :label="$t('app.signup.left.form.password')"
                  outlined
                  density="compact"
                  :append-inner-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="showPassword ? 'text' : 'password'"
                  :rules="registrationPasswordRules($t('app.forms.person.validations.password_required'))"
                  @click:append-inner="showPassword = !showPassword"
              />

              <NuxtTurnstile v-model="token" :options="options" data-size="flexible" />

              <VBtn
                  block
                  color="primary"
                  class="my-8 text-capitalize font-weight-bold"
                  :loading="loading"
                  type="submit"
              >{{ $t('app.signup.left.form.signup') }}
              </VBtn>
            </VForm>

            <p class="white--text">
              {{ $t("app.signup.left.existing_account_question") }}
              <NuxtLink class="text-blue-lighten-1" :to="localePath('/')">{{ $t("app.signup.left.sign_in") }}</NuxtLink>
            </p>

          </div>
        </VCard>
      </VCol>
      <VCol cols="12" md="6" class="right-card">
        <div class="d-flex justify-end mr-6">
          <LocaleSwitcher />
        </div>
        <div class="d-flex flex-column justify-center align-center align-md-start fill-height">
          <VCard tile flat class="ml-16" max-width="400" color="transparent">
            <div>
              <h3 class="mb-6">{{ $t('app.signup.right.title') }}</h3>

              <VList bg-color="transparent">
                <VListItem v-for="(feature, i) in teamFeatures" :key="i" class="px-0">
                  <template #prepend>
                    <v-icon color="primary">mdi-check-circle</v-icon>
                  </template>
                  <template #default>
                    <p>{{ $rt(feature) }}</p>
                  </template>
                </VListItem>
              </VList>

              <h4 class="my-4">{{ $t('app.signup.right.call_to_action') }}</h4>
            </div>
          </VCard>
        </div>
      </VCol>
    </VRow>
  </VCard>
</template>

<style scoped>
.right-card {
  background: url("../../public/images/admin-signup.jpg") no-repeat;
  background-size: cover;
}

@media only screen and (max-width: 850px) {
  .right-card {
    background: whitesmoke;
  }
}
</style>