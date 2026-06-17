<script setup lang="ts">

import type {User} from "#bookisia-shared-module/types";
import {useSanctumUser} from "#imports";

const localePath = useLocalePath()
const user = useSanctumUser<User>()

function handleClick() {
  useRouter().push(localePath('/dashboard/account/subscription/new'))
}
</script>

<template>
<VCard max-width="400">
  <VCardItem>
    <h4>{{$t('app.dashboard.trial_expiration_counter.title', {days: user?.staff?.tenant?.remaining_trial_period_days})}}</h4>
    <p class="my-4 text-grey">{{$t('app.dashboard.trial_expiration_counter.subtitle')}}</p>
    <VBtn color="primary" @click="handleClick">{{$t('app.dashboard.trial_expiration_counter.action_btn')}}</VBtn>
  </VCardItem>
</VCard>
</template>

<style scoped>

</style>