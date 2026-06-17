<script setup lang="ts">

const {
  categories,
  title,
  form,
  formValidity,
  image,
  uploadNewImage,
  submitButtonText,
  isNewMode,
  handleSubmit
} = await useServiceForm()
const {genericRequiredRule} = useValidationRules()

const addPriceVariation = ref(false)

const headers = [
  {
    title: 'Name',
    value: 'name'
  },
  {
    title: 'Price',
    value: 'price'
  },
  {
    title: 'Duration',
    value: 'duration'
  },
  {
    title: '',
    value: 'action'
  },
]

const hasVariations = computed(() => form.variations && form.variations.length > 1)

function removeVariation(variationId: number) {
  const index = form?.variations?.findIndex(v => v.id === variationId)
  if (index !== -1) return

  form?.variations?.splice(index, 1)
}
</script>

<template>
  <VDialog :model-value="true" fullscreen scrollable>
    <VForm v-model="formValidity" validate-on="blur lazy" @submit.prevent="handleSubmit">
      <VCard flat>
        <VCardTitle class="d-flex justify-space-between">
          <VBtn icon flat to="/dashboard/services">
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
              <h4 class="mt-4 mb-1">{{$t('app.services.form.service_image')}}</h4>
              <ImageViewer
                  v-if="!isNewMode && !uploadNewImage"
                  class="mb-4"
                  :image-url="form.image_url!"
                  entity-type="service"
                  :entity-id="form.id!"
              />

              <VRow v-if="isNewMode">
                <VCol>
                  <VFileUpload v-model="image" density="compact" clearable/>
                </VCol>
              </VRow>

              <VRow>
                <VCol cols="12">
                  <h4>{{$t('app.services.form.service_name')}}</h4>
                  <VTextField
                      v-model="form.name"
                      variant="outlined"
                      density="compact"
                      :rules="genericRequiredRule('Service name is required')"
                  />
                </VCol>
                <VCol cols="12">
                  <h4>{{$t('app.dictionary.description')}}</h4>
                  <VTextField
                      v-model="form.description"
                      variant="outlined"
                      density="compact"
                      :rules="genericRequiredRule('Description is required')"
                  />
                </VCol>
              </VRow>

              <VRow class="mt-4">
                <VCol cols="12">
                  <h4>{{$t('app.dictionary.categories')}}</h4>
                  <VSelect
                      v-model="form.categories"
                      :items="categories"
                      variant="outlined"
                      density="compact"
                      item-title="name"
                      multiple
                      return-object
                  />
                </VCol>
              </VRow>

              <ServiceVariationForm v-if="!hasVariations" v-model="form.variations![0]!"/>
              <VRow v-else>
                <VCol cols="12">
                  <div class="d-flex justify-space-between mb-2">
                    <h4 class="mt-2">Variations</h4>
                    <VBtn rounded size="small" class="mt-4" @click="addPriceVariation = true">
                      <VIcon>mdi-plus</VIcon>
                      Add
                    </VBtn>
                  </div>
                  <VDataTable :items="form.variations" :headers="headers" hide-default-footer>
                    <template #item.action="{item}">
                      <VBtn icon flat @click="removeVariation(item.id!)">
                        <VIcon>mdi-minus</VIcon>
                      </VBtn>
                    </template>
                  </VDataTable>
                </VCol>
              </VRow>

              <VRow v-if="!hasVariations">
                <VCol cols="10">
                  <h4>{{$t('app.dictionary.variations')}}</h4>
                  <small>{{$t('app.services.form.variations_text')}}</small>
                </VCol>

                <VCol cols="2">
                  <VBtn rounded size="small" class="mt-4" @click="addPriceVariation = true">
                    <VIcon>mdi-plus</VIcon>
                    {{$t('app.dictionary.add')}}
                  </VBtn>
                </VCol>
              </VRow>
            </VCardText>
          </VCard>
        </VCardText>
      </VCard>
    </VForm>
  </VDialog>
  <VDialog v-if="addPriceVariation" v-model="addPriceVariation" max-width="600" scrollable>
    <ServiceVariationManager v-model="form.variations" @hide-dialog="addPriceVariation=false"/>
  </VDialog>
</template>

