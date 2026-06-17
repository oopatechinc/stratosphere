<script setup lang="ts">
const localePath = useLocalePath()
const {actions} = usePendingActions()

const showSetupDialog = ref(false)


function handleCreateWebsite() {
  return useRouter().push(localePath('/dashboard/sites/create-website'))

  // if (!actions.value.length) {
  //   return useRouter().push(localePath('/dashboard/sites/create-website'))
  // }

  // showSetupDialog.value = true
}

</script>

<template>
  <div class="container pa-2 d-flex flex-column justify-center">
    <VCard max-width="600" color="transparent" flat class="ml-16">
      <VCardText>
        <div class="text-center d-flex flex-column justify-center">
          <div class="mb-6">
            <h2 class="title-text text-white">
              {{$t('app.sites.create_website.create_your')}}
              <span class="text-black text-lowercase">{{$t('app.dictionary.first')}}</span>
              {{$t('app.dictionary.website').toLowerCase()}}.
            </h2>
            <h3 class="text-black my-6">{{$t('app.sites.create_website.subtext')}}</h3>
          </div>
          <VBtn color="black" size="large" @click="handleCreateWebsite">{{$t('app.sites.create_website.action_btn')}}</VBtn>
        </div>
      </VCardText>
    </VCard>

    <VDialog v-model="showSetupDialog" max-width="600">
      <SitePendingActions @hide-dialog="showSetupDialog=false"/>
    </VDialog>
  </div>

</template>

<style scoped>
.container {
  background-image: url('../../../public/images/create-website.jpg');
  background-position: left;
  background-repeat: no-repeat;
  background-size: cover;
  height: 100vh;
}

.title-text {
  font-size: 6rem;
}
</style>