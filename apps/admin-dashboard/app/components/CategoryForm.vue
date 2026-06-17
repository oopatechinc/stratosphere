<script setup lang="ts">
const {
  title,
  form,
  formValidity,
  uploadNewImage,
  submitButtonText,
  isNewMode,
  image,
  handleSubmit,
} = await useCategoryForm()
const {genericRequiredRule} = useValidationRules()

const servicesStore = useServicesStore()
await servicesStore.fetch()

const {services} = storeToRefs(useServicesStore())
</script>

<template>
  <VDialog :model-value="true" scrollable fullscreen>
    <VCard flat>
      <VForm v-model="formValidity" validate-on="blur lazy" @submit.prevent="handleSubmit">
        <VCardTitle class="d-flex justify-space-between">
          <VBtn icon flat to="/dashboard/categories">
            <VIcon>mdi-close</VIcon>
          </VBtn>
          <VBtn flat variant="outlined" rounded prepend-icon="mdi-cloud" type="submit">
            {{ submitButtonText }}
          </VBtn>
        </VCardTitle>

        <VCardText>
          <VCard max-width="600" class="mx-auto" flat>
            <VCardTitle class="d-flex justify-space-between">
              <h3>{{ title }}</h3>
            </VCardTitle>
            <VCardText>
              <h4 class="mt-4 mb-1">Category Image</h4>
              <ImageViewer
                  v-if="!isNewMode && !uploadNewImage"
                  class="mb-4"
                  :image-url="form.image_url!"
                  entity-type="category"
                  :entity-id="form.id!"
              />

              <VRow v-if="isNewMode">
                <VCol>
                  <VFileUpload v-model="image" density="compact" clearable/>
                </VCol>
              </VRow>

              <VRow>
                <VCol cols="12">
                  <h4>Category Name</h4>
                  <VTextField
                      v-model="form.name"
                      variant="outlined"
                      density="compact"
                      :rules="genericRequiredRule('Category name is required')"
                  />
                </VCol>

                <VDivider/>

                <VCol cols="12">
                  <h4>Services</h4>
                  <div class="my-2 bg-grey-lighten-3 pa-3">
                    <VIcon class="mr-2" color="info">mdi-information</VIcon>
                    <small>You can select one or more services to associate with this category</small>
                  </div>
                  <VSelect
                      v-model="form.services"
                      :items="services"
                      variant="outlined"
                      density="compact"
                      item-title="name"
                      item-value="id"
                      multiple
                      return-object
                  />
                </VCol>
              </VRow>
            </VCardText>
          </VCard>
        </VCardText>
      </VForm>
    </VCard>
  </VDialog>
</template>

