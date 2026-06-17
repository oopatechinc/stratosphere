<script setup lang="ts">
import {VPhoneInput} from "v-phone-input";

const {
  services,
  staffs,
  title,
  location,
  locationTypes,
  formValidity,
  submitButtonText,
  handleSubmit
} = await useLocationForm()

const {genericRequiredRule, emailRequiredRules} = useValidationRules()

const showConfirmationDialog = ref(false)

const config = useRuntimeConfig()

watch(() => location.nickname, (nickname) => {
  location.subdomain = nickname.replace(/[^a-zA-Z0-9]/g, "").toLowerCase();
})
</script>

<template>
  <VDialog :model-value="true" scrollable fullscreen>
    <VForm v-model="formValidity" validate-on="blur lazy" @submit.prevent="handleSubmit">
      <VCard flat>
        <VCardTitle class="d-flex justify-space-between">
          <VBtn icon flat to="/dashboard/business/locations">
            <VIcon>mdi-close</VIcon>
          </VBtn>
          <VBtn flat variant="outlined" rounded prepend-icon="mdi-cloud" type="submit">
            {{ submitButtonText }}
          </VBtn>
        </VCardTitle>

        <VCardText>
          <VCard max-width="600" class="mx-auto" flat>
            <VCardTitle class="d-flex justify-space-between mb-6">
              <h3>{{ title }}</h3>
            </VCardTitle>
            <VCardText>
              <VRow>
                <VCol cols="12">
                  <VTextField
                      v-model="location.nickname"
                      variant="outlined"
                      density="compact"
                      :label="$t('app.locations.form.nickname')"
                      :rules="genericRequiredRule('Location nickname is required')"
                  />
                </VCol>
                <VCol cols="12">
                  <VTextField
                      v-model="location.subdomain"
                      variant="outlined"
                      density="compact"
                      :label="$t('app.locations.form.website_url')"
                      :rules="genericRequiredRule('Location nickname is required')"
                  >
                    <template #append-inner>
                      <p>{{config.public.locationWebsiteSuffix}}</p>
                    </template>
                  </VTextField>
                </VCol>
                <VCol cols="12">
                  <VSelect
                      v-model="location.type"
                      :items="locationTypes"
                      density="compact"
                      :label="$t('app.locations.form.type')"
                      :rules="genericRequiredRule('Location type is required')"
                  />
                </VCol>
              </VRow>

              <h3 class="my-6">{{$t('app.dictionary.address')}}</h3>
              <AddressForm v-model="location.address"/>

              <h3 class="my-6">{{$t('app.locations.form.contact_information')}}</h3>
              <VRow>
                <VCol cols="12" md="6">
                  <VTextField
                      v-model="location.email"
                      :label="$t('app.dictionary.email')"
                      variant="outlined"
                      density="compact"
                      :rules="emailRequiredRules('Email is required')"
                  />
                </VCol>
                <VCol cols="12" md="6">
                  <VPhoneInput
                      v-model="location.phone"
                      :label="$t('app.multi_words.phone_number')"
                      density="compact"
                      variant="outlined"
                      :guess-country="true"
                      :enable-searching-country="true"
                      :rules="genericRequiredRule('Phone is required')"
                  />
                </VCol>
              </VRow>

              <h3 class="my-6">{{$t('app.locations.form.social_contact.title')}}</h3>
              <VRow>
                <VCol cols="12" md="6">
                  <VTextField
                      v-model="location.instagram_account"
                      label="Instagram"
                      prepend-inner-icon="mdi-instagram"
                      variant="outlined"
                      density="compact"
                  />
                </VCol>
                <VCol cols="12" md="6">
                  <VTextField
                      v-model="location.facebook_account"
                      label="Facebook"
                      prepend-inner-icon="mdi-facebook"
                      variant="outlined"
                      density="compact"
                  />
                </VCol>
                <VCol cols="12" md="6">
                  <VTextField
                      v-model="location.linkedin_account"
                      label="LinkedIn"
                      prepend-inner-icon="mdi-linkedin"
                      variant="outlined"
                      density="compact"
                  />
                </VCol>
                <VCol cols="12" md="6">
                  <VTextField
                      v-model="location.x_account"
                      label="X"
                      prepend-inner-icon="mdi-alpha-x"
                      variant="outlined"
                      density="compact"
                  />
                </VCol>
              </VRow>

              <h3 class="my-6">{{$t('app.dictionary.branding')}}</h3>
              <p>{{$t('app.locations.form.branding.subtitle')}}</p>
              <VBtn class="mt-4" :text="$t('app.locations.form.branding.action_btn')" rounded variant="outlined"/>

              <h3 class="my-6">{{$t('app.locations.form.business_hours.title')}}</h3>
              <SharedOpeningDays :model-value="location.opening_days"/>

              <div class="d-flex justify-space-between align-center">
                <h3 class="my-6">{{$t('app.dictionary.services')}}</h3>
                <VBtn icon="mdi-plus" variant="tonal" color="primary" size="small" @click="showConfirmationDialog=true"/>
              </div>
              <p class="mb-4">{{$t('app.locations.form.services.subtitle')}}</p>

              <VAutocomplete
                  v-model="location.services"
                  :items="services"
                  item-title="name"
                  item-value="id"
                  multiple
                  chips
                  return-object
                  :rules="genericRequiredRule('Services is required')"
              />

              <h3 class="my-6">{{$t('app.locations.form.staff.title')}}</h3>
              <p class="mb-4">{{$t('app.locations.form.staff.subtitle')}}</p>

              <VAutocomplete
                  v-model="location.staff"
                  :items="staffs"
                  item-title="user.full_name"
                  item-value="id"
                  multiple
                  chips
                  return-object
                  :rules="genericRequiredRule('Staff is required')"
              />

            </VCardText>
          </VCard>
        </VCardText>
      </VCard>
    </VForm>

    <SharedConfirmationDialog
        v-model="showConfirmationDialog"
        url="/dashboard/services/new"
        :text="$t('app.locations.form.business_hours.confirm_action.text')"
    />
  </VDialog>
</template>

