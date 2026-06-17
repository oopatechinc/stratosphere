<script setup lang="ts">
const {
  staff,
  submitBtnText,
  formValidity,
  isNewMode,
  image,
  handleSubmit
} = await useTeamMemberForm()

</script>

<template>
  <VDialog :model-value="true" scrollable fullscreen>
    <VForm v-model="formValidity" validate-on="blur lazy" @submit.prevent="handleSubmit">
      <VCard flat>
        <VCardTitle>
          <div class="d-flex justify-space-between">
            <VBtn icon flat to="/dashboard/team/team-members">
              <VIcon>mdi-close</VIcon>
            </VBtn>
            <div>
              <VBtn flat variant="outlined" rounded :text="submitBtnText" type="submit"/>
            </div>

          </div>
        </VCardTitle>

        <VCardText>
          <VCard flat max-width="600" class="mx-auto">
            <ImageViewer
                v-if="!isNewMode"
                class="mb-4"
                :image-url="staff.image_url!"
                entity-type="staff"
                :entity-id="staff.id!"
            />

            <VRow v-else>
              <VCol>
                <VFileUpload v-model="image" density="compact" clearable/>
              </VCol>
            </VRow>

            <h3 class="my-6">Profile</h3>
            <UserForm v-model="staff.user"/>

            <h3 class="my-6">Address</h3>
            <AddressForm v-model="staff.address"/>

            <h3 class="my-6">Job</h3>
            <TeamMemberJobsForm v-model="staff.occupations" />

            <h3 class="my-6">Services</h3>
            <TeamMemberServicesForm v-model="staff.services" />

            <TeamMemberTimeBlocks v-model="staff.time_blocks" />
          </VCard>
        </VCardText>
      </VCard>
    </VForm>
  </VDialog>
</template>

