<script setup lang="ts">
import type {CollectionItem, CollectionProperty} from "@stratosphere/core-layer/types";

const props = defineProps<{type: string, returnUrl: string }>()
const {
  title,
  formValidity,
  images,
  uploadNewImage,
  submitButtonText,
  isNewMode,
  handleSubmit
} = await useCollectionItemsForm(props.type, props.returnUrl)
const {genericRequiredRule} = useValidationRules()

const form = ref<CollectionItem>({
  id: -1,
  collection_type: 'properties',
  content: <CollectionProperty>{}
})

</script>

<template>
  <VDialog :model-value="true" fullscreen scrollable>
    <VForm v-model="formValidity" validate-on="blur lazy" @submit.prevent="handleSubmit(form)">
      <VCard flat>
        <VCardTitle class="d-flex justify-space-between">
          <VBtn icon flat to="/dashboard/properties">
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
              <h4 class="mt-4 mb-1">{{$t('app.properties.form.property_image')}}</h4>
              <ImageViewer
                  v-if="!isNewMode && !uploadNewImage"
                  class="mb-4"
                  :image-url="form.content.image_url"
                  entity-type="property"
                  :entity-id="form.id!"
              />

              <VRow v-if="isNewMode">
                <VCol>
                  <VFileUpload
                      v-model="images"
                      density="compact"
                      multiple
                      clearable
                  />
                </VCol>
              </VRow>

              <VRow>
                <VCol cols="12">
                  <h4>{{$t('app.properties.form.property_name')}}</h4>
                  <VTextField
                      v-model="form.content.name"
                      variant="outlined"
                      density="compact"
                      :rules="genericRequiredRule($t('app.properties.form.validations.property_name_required'))"
                  />
                </VCol>
                <VCol cols="12">
                  <h4>{{$t('app.dictionary.description')}}</h4>
                  <VTextField
                      v-model="form.content.description"
                      variant="outlined"
                      density="compact"
                      :rules="genericRequiredRule($t('app.properties.form.validations.property_description_required'))"
                  />
                </VCol>
                <VCol cols="12">
                  <h4>{{$t('app.dictionary.price')}}</h4>
                  <VTextField
                      v-model="form.content.price"
                      variant="outlined"
                      density="compact"
                      :rules="genericRequiredRule($t('app.properties.form.validations.property_description_required'))"
                  />
                </VCol>
                <VCol cols="12">
                  <h4>{{$t('app.dictionary.address')}}</h4>
                  <VTextField
                      v-model="form.content.address"
                      variant="outlined"
                      density="compact"
                      append-inner-icon="mdi-map-marker"
                      :rules="genericRequiredRule($t('app.properties.form.validations.property_address_required'))"
                  />
                </VCol>
              </VRow>

              <VRow class="mt-4">
                <VCol cols="12" md="4">
                  <h4>{{$t('app.properties.form.number_of_rooms')}}</h4>
                  <VSelect
                      v-model="form.content.rooms"
                      :items="[1,2,3,4,5,6,7,8,9,10]"
                      variant="outlined"
                      density="compact"
                  />
                </VCol>
                <VCol cols="12" md="4">
                  <h4>{{$t('app.properties.form.number_of_beds')}}</h4>
                  <VSelect
                      v-model="form.content.beds"
                      :items="[1,2,3,4,5,6,7,8,9,10]"
                      variant="outlined"
                      density="compact"
                  />
                </VCol>
                <VCol cols="12" md="4">
                  <h4>{{$t('app.properties.form.number_of_baths')}}</h4>
                  <VSelect
                      v-model="form.content.baths"
                      :items="[1,2,3,4,5,6,7,8,9,10]"
                      variant="outlined"
                      density="compact"
                  />
                </VCol>
              </VRow>
            </VCardText>
          </VCard>
        </VCardText>
      </VCard>
    </VForm>
  </VDialog>
</template>

