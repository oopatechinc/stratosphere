<script setup lang="ts">
import type {User} from "#bookisia-shared-module/types"

const user = useSanctumUser<User>()
const staffImage = user.value?.staff?.image_url
    ?? 'https://bookisia-public.s3.ca-central-1.amazonaws.com/images/user/default.png'
</script>

<template>
  <div v-if="user">
    <ImageViewer
        :image-url="staffImage"
        entity-type="staff"
        :entity-id="user!.staff!.id!"
        class="mb-8"
    />
    <UserForm v-model="user" />
  </div>
</template>

<style scoped>

</style>