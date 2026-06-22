<script setup lang="ts">

import {useValidationRules} from "#imports";

definePageMeta({
  layout: 'blank'
})

const {genericRequiredRule, emailRequiredRules} = useValidationRules()

const localePath = useLocalePath()

const email = ref('')
const password = ref('')
const formValidity = ref(null)

const turnstileToken = ref()

const showPassword = ref(false)
const loading = ref(false)
const options = {
  theme: 'dark',
  appearance: 'interaction-only'
} as Turnstile.RenderParameters

async function login() {
  if (formValidity.value !== true) return

  if (!turnstileToken.value) {
    return useSnackbarStore().displayErrorMessage($t('app.signin.turnstile.validation_error'))
  }
  await useSanctumAuth().login({email: email.value, password: password.value} )
}

</script>

<template>
  <div class="content-login">
    <VCard tile color="black" class="d-flex flex-row align-center justify-space-between">

      <VCard tile class="image-login">
        <VCarousel hide-delimiters :show-arrows="false" height="100vh" cycle continuous>
          <VCarouselItem src="/images/barbershop.jpg" height="100vh" cover/>
          <VCarouselItem src="/images/login-slide-2.jpg" height="100vh" cover/>
          <VCarouselItem src="/images/login-slide-3.jpg" height="100vh" cover/>
        </VCarousel>
      </VCard>

      <VCard color="transparent" elevation="0" tile>
        <div class="d-flex justify-end px-4">
          <LocaleSwitcher />
        </div>

        <div class="d-flex flex-column align-center justify-center form-login">
          <VForm v-model="formValidity" validate-on="blur lazy" @submit.prevent="login">
            <div class="form-login-container text-center">

              <VImg src="/images/logo.svg" alt="logo"/>

              <p class="my-8 font-weight-bold white--text sign-in-text">
                {{$t('app.signin.title')}}
              </p>
              <VTextField
                  v-model="email"
                  :placeholder="$t('app.signin.username_placeholder')"
                  background-color="white"
                  outlined
                  dense
                  :rules="emailRequiredRules($t('app.forms.person.validations.email_required'))"
              />

              <VTextField
                  v-model="password"
                  :placeholder="$t('app.dictionary.password')"
                  background-color="white"
                  outlined
                  dense
                  :append-inner-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="showPassword ? 'text' : 'password'"
                  :rules="genericRequiredRule('Password is required')"
                  @click:append="showPassword = !showPassword"
                  @keyup.enter="login"
              />

              <div class="d-flex justify-space-between">
                <p class="white--text">{{$t('app.signin.remember_me')}}</p>
                <p class="primary--text">
                  <NuxtLink
                      class="text-blue-lighten-1"
                      :to="localePath('/forgot-password')">
                    {{$t('app.signin.forgot_password')}}
                  </NuxtLink>
                </p>
              </div>

              <NuxtTurnstile
                  v-model="turnstileToken"
                  :options="options"
                  data-size="flexible"
              />

              <VBtn
                  :loading="loading"
                  color="primary"
                  class="my-8 text-capitalize font-weight-bold"
                  size="large"
                  block
                  type="submit"
              >{{$t('app.dictionary.sign_in')}}
              </VBtn>
              <p class="white--text">
                {{$t('app.signin.no_account_text')}}
                <NuxtLink
                    class="text-blue-lighten-1"
                    :to="localePath('/signup')"
                >{{$t('app.dictionary.sign_up')}}</NuxtLink>
              </p>
            </div>
          </VForm>
        </div>
      </VCard>
    </VCard>
  </div>
</template>

<style scoped>
.content-login .v-card {
  height: 100vh;
  font-size: 14px;
}

.content-login .v-card .v-card {
  width: 50%;
}

@media only screen and (max-width: 850px) {

  .content-login .v-card .v-card {
    width: 100%;
  }

  .content-login .image-login {
    display: none;
  }

}

.content-login .v-card.form-login {
  height: auto;
}

.content-login .sign-in-text {
  font-size: 20px;
}

.content-login .form-login-container {
  width: 350px;
}

@media only screen and (max-width: 380px) {

  .content-login .form-login-container {
    width: 90%;
  }

}

.content-login .form-login-container img {
  width: 70%;
}

</style>