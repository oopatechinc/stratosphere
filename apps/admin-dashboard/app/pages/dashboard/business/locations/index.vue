<script setup lang="ts">
import type {Location, User} from "#bookisia-shared-module/types";
import {useSanctumUser} from "#imports";

const store = useLocationsStore()
const {encrypter} = useUtils()
const user = useSanctumUser<User>()
const localePath = useLocalePath()

const minimumShowFooterLength = 11

//init the locations store
await store.fetch(`?business_id=${user.value?.staff?.business_id}`)
const {locations} = storeToRefs(store)

const showActionCard = ref(false)
const currentLocation = ref<Location>()

currentLocation.value = locations.value[0]

const headers = [
  {title: 'Nickname', value: 'nickname'},
  {title: 'Type', value: 'type'},
  {title: 'Address', value: 'address'},
  {title: '', value: 'action'}
]

const openingHours = [
  {
    props: {
      title: "Monday",
      subtitle: "9AM - 5PM",
      prependIcon: "mdi-calendar"
    }
  },
  { type: 'divider', inset: true },
  {
    props: {
      title: "Tuesday",
      subtitle: "9AM - 5PM",
      prependIcon: "mdi-calendar"
    }
  },
  { type: 'divider', inset: true },
  {
    props: {
      title: "Wednesday",
      subtitle: "9AM - 5PM",
      prependIcon: "mdi-calendar"
    }
  },
  { type: 'divider', inset: true },
  {
    props: {
      title: "Thursday",
      subtitle: "9AM - 5PM",
      prependIcon: "mdi-calendar"
    }
  },
  { type: 'divider', inset: true },
  {
    props: {
      title: "Friday",
      subtitle: "9AM - 5PM",
      prependIcon: "mdi-calendar"
    }
  },
]

function handleLocationClick(location: Location) {
  currentLocation.value = location
  showActionCard.value = !showActionCard.value
}

function goto(itemId: number) {
  navigateTo(`/dashboard/business/locations/${encrypter(String(itemId))}`)
}

</script>

<template>
  <div class="container pa-2">
    <div v-if="locations.length !== 0" class="d-flex justify-space-between">
      <h3>Locations</h3>
      <VBtn rounded color="black" flat to="/dashboard/business/locations/new">Add Location</VBtn>
    </div>

    <VCard v-if="locations.length === 0">
      <VCardText class="d-flex justify-center">
        <div class="text-center">
          <VIcon size="60">mdi-folder-outline</VIcon>
          <h3 class="mt-3 mb-2">{{$t('app.locations.index.create_card.title')}}</h3>
          <p class="mb-2">{{$t('app.locations.index.create_card.subtitle')}}
          </p>
          <VBtn color="primary" :to="localePath('/dashboard/business/locations/new')">
            {{$t('app.locations.index.create_card.action_btn')}}
          </VBtn>
        </div>
      </VCardText>
    </VCard>
    <VRow v-else no-gutters>
      <VCol>
        <VCard class="mt-10">
          <VDataTable
              :headers="headers"
              :items="locations"
              :hide-default-footer="locations.length < minimumShowFooterLength"
              hover
          >
            <template #item="{ item }">
              <tr class="text-no-wrap" @click="handleLocationClick(item)">
                <td>{{ item.nickname }}</td>
                <td>{{ item.type }}</td>
                <td>
                  <span v-if="item.address">{{ item?.address?.full_address }}</span>
                  <span v-else class="text-decoration-underline text-red">Missing address</span>
                </td>
                <td class="text-end">
                  <VIcon icon="mdi-chevron-right" flat/>
                </td>
              </tr>
            </template>
          </VDataTable>
        </VCard>
      </VCol>

      <VCol v-if="showActionCard" cols="3">
        <VCard elevation="10" class="mt-2">
          <VCardTitle>
            {{currentLocation!.nickname}}
          </VCardTitle>
          <VCardText>
            <VCard class="mt-4">
              <VCardTitle class="d-flex justify-space-between">
                <p>Address</p>
                <VBtn text="Edit" variant="text" class="text-decoration-underline" @click="goto(currentLocation!.id!)"/>
              </VCardTitle>
              <VCardText>
                <div>{{currentLocation?.address?.full_address}}</div>
              </VCardText>
            </VCard>

            <VCard class="mt-4">
              <VCardTitle class="d-flex justify-space-between mb-2">
                Opening Hours
                <VBtn
                    text="Edit"
                    variant="text"
                    class="text-decoration-underline"
                    :to="`/dashboard/business/locations/${encrypter(String(currentLocation!.id))}`"
                />
              </VCardTitle>
              <VCardText>
                <VList :items="openingHours" />
              </VCardText>
            </VCard>

            <VCard class="mt-4">
              <VCardTitle class="d-flex justify-space-between mb-2">
                Brand
                <VBtn
                    text="Edit"
                    variant="text"
                    class="text-decoration-underline"
                    :to="`/dashboard/business/locations/${encrypter(String(currentLocation!.id))}`"
                />
              </VCardTitle>
              <VCardText>
                <div class="text-grey text-uppercase">Primary Job</div>
                <div>{{currentLocation?.email}}</div>
              </VCardText>
            </VCard>
          </VCardText>
        </VCard>
      </VCol>
    </VRow>
  </div>
</template>

<style scoped>

</style>