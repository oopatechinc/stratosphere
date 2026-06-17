<script setup lang="ts">
import {useSnackbarStore} from "#imports";
import {RedirectFactory} from "~/classes/RedirectFactory"

const route = useRoute()
const router = useRouter()
const localePath = useLocalePath()
const {displayErrorMessage} = useSnackbarStore()

const state = route.query.state as string

if (!state) {
  displayErrorMessage('Invalid query provided')
  router.push(localePath('/dashboard'))
}

const parsedState = JSON.parse(state) as {action: string}

const factory = (new RedirectFactory()).getInstance(parsedState.action)
await factory?.handle()

</script>

<template>
  <div class="wrapper">
    <div class="content">
      <VCard
          class="mx-auto"
          max-width="344"
          rounded
          color="white"
          elevation="10"
      >
        <VContainer style="height: 400px;">
          <VRow
              class="fill-height"
              align-content="center"
              justify="center"
          >
            <VCol class="text-subtitle-1 text-center" cols="12">
              <p>Hang tight! You will be redirected shortly...</p>
            </VCol>
            <VCol cols="12">
              <VProgressLinear
                  color="blue accent-4"
                  :size="100"
                  indeterminate
                  rounded
                  height="60"
              />
            </VCol>

            <div>
              <i><small>This may take a few minutes</small></i>
            </div>
          </VRow>
        </VContainer>
      </VCard>
    </div>
    <div class="bottom">
      <VImg
          alt="Bookisia Logo"
          class="mx-auto py-4"
          contain
          src="/images/logo.svg"
          transition="scale-transition"
          width="200"
      />
    </div>
  </div>
</template>

<style scoped>
.wrapper {
  height: 100vh;
  background-color: #f5f5f5;
}

.content {
  padding-top: 30px;
}

.bottom {
  background-color: black;
  margin-top: 30px;
}

</style>
