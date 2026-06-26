<script setup lang="ts">
import type {User} from "@stratosphere/core-layer/types"
import {useStaffsStore} from "#imports";

const user = useSanctumUser<User>()
const staffStore = useStaffsStore()
const {staffs} = storeToRefs(staffStore)
await staffStore.fetch()

const currentStaff = computed(() => {
  return staffs.value.find(s => s.user_id === user.value?.id)
})


const staffImage = currentStaff.value?.image_url
    ?? 'https://bookisia-public.s3.ca-central-1.amazonaws.com/images/user/default.png'

</script>

<template>
  <div v-if="currentStaff">
    <ImageViewer
        :image-url="staffImage"
        entity-type="staff"
        :entity-id="currentStaff.id"
        class="mb-8"
    />
    <UserForm v-model="user as User" />
  </div>
</template>