<script setup lang="ts">
import type {Staff, User} from "@stratosphere/core-layer/types";

const {fetch} = useStaffsStore()
const {staffs} = storeToRefs(useStaffsStore())
const user = useSanctumUser<User>()
const {encrypter} = useUtils()
const {t} = useI18n()

await fetch()

const minimumShowFooterLength = 11

const showActionCard = ref(false)
const currentStaff = ref<Staff>()

const headers = computed(() => {
  return [
    {title: t('app.dictionary.name'), value: 'name'},
    {title: t('app.dictionary.job'), value: 'job'},
    {title: '', value: 'status'},
  ]
})

const statuses = computed(() => {
  return [
    {
      status: 'active',
      text: t('app.dictionary.active')
    },
    {
      status: 'inactive',
      text: t('app.dictionary.inactive')
    }
  ]
})

const shortcuts = computed(() => {
  return [
    {
      title: $t('app.dictionary.personal_information'),
      props: {
        to: `/dashboard/team/team-members/${encrypter(String(currentStaff.value?.id))}`,
        prependIcon: 'mdi-account',
        subtitle: currentStaff.value?.user?.email,
        appendIcon: 'mdi-pencil'
      }
    },
    {
      title: $t('app.dictionary.address'),
      props: {
        to: `/dashboard/team/team-members/${encrypter(String(currentStaff.value?.id))}`,
        prependIcon: 'mdi-map-marker',
        subtitle: currentStaff.value?.address?.full_address,
        appendIcon: 'mdi-pencil'
      }
    },
    {
      title: $t('app.dictionary.permissions'),
      props: {
        to: `/dashboard/team/team-members/${encrypter(String(currentStaff.value?.id))}`,
        prependIcon: 'mdi-lock',
        appendIcon: 'mdi-pencil'
      }
    },
    {
      title: $t('app.dictionary.services'),
      props: {
        to: `/dashboard/team/team-members/${encrypter(String(currentStaff.value?.id))}`,
        prependIcon: 'mdi-cog',
        appendIcon: 'mdi-pencil',
        subtitle: currentStaff.value?.services?.map(s => s.name).join(', ')
      }
    },
    {
      title: $t('app.dictionary.jobs'),
      props: {
        to: `/dashboard/team/team-members/${encrypter(String(currentStaff.value?.id))}`,
        prependIcon: 'mdi-briefcase',
        appendIcon: 'mdi-pencil',
        subtitle: currentStaff.value?.occupations?.map(o => o.title).join(', ')
      }
    },
    {
      title: $t('app.dictionary.time_blocks'),
      props: {
        to: `/dashboard/team/team-members/${encrypter(String(currentStaff.value?.id))}`,
        prependIcon: 'mdi-calendar',
        appendIcon: 'mdi-pencil',
        subtitle: currentStaff.value?.time_blocks?.map(t => t.dates.map(d => d.date)).join(', ')
      }
    },
  ]
})

function handleStaffClick(staff: Staff) {
  currentStaff.value = staff
  showActionCard.value=!showActionCard.value
}

</script>

<template>
  <div class="container pa-2">
    <div class="d-flex justify-space-between">
      <h3>{{$t('app.team_members.page_title')}}</h3>
      <VBtn rounded color="black" flat to="/dashboard/team/team-members/new">{{$t('app.team_members.action_btn')}}</VBtn>
    </div>

    <VRow no-gutters>
      <VCol>
        <VCard class="mt-10" flat>
          <VCardText>
            <VDataTable
                :headers="headers"
                :items="staffs"
                :hide-default-footer="staffs!.length < minimumShowFooterLength"
                hover
            >
              <template #item="{ item }">
                <tr class="text-no-wrap" @click="handleStaffClick(item)">
                  <td>{{ item.user?.full_name }}</td>
                  <td>{{ item.occupations?.map(o => o.title).join(', ') }}</td>
                  <td class="text-end">
                    <VChip
                        :color="item.status == 'active' ? 'success' : 'amber'"
                        :text="statuses.find(s => s.status === item.status)?.text"
                    />
                  </td>
                </tr>
              </template>
            </VDataTable>

            <span class="v-card-subtitle">
              {{ staffs!.length }}
              <span class="text-lowercase">
                {{staffs!.length > 1
                  ? $t('app.team_members.title')
                  : $t('app.team_members.solo_staff')
                }}</span>
            </span>
          </VCardText>
        </VCard>
      </VCol>

      <VCol v-if="showActionCard" cols="4">
        <VCard elevation="10" class="mt-2">
          <VCardTitle class="d-flex justify-space-between align-center elevation-1">
            <VList>
              <VListItem
                  :prepend-avatar="currentStaff?.image_url"
                  :title="user?.full_name"
              />
            </VList>
            <VBtn icon="mdi-close" flat @click="showActionCard=false" />
          </VCardTitle>
          <VCardText class="mt-1">
            <VList :items="shortcuts" />
          </VCardText>
        </VCard>
      </VCol>
    </VRow>

  </div>
</template>

<style scoped>

</style>