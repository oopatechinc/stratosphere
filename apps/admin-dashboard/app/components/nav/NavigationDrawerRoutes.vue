<script setup lang="ts">
import {useAppStore} from "#imports";

const {t} = useI18n()
const localePath = useLocalePath()
const {isVertical} = useAppStore()

interface PROP {
  title: string,
  prependIcon: string,
  value?: string,
  to?:string
}

interface CHILD_ITEM {
  props: PROP,
  children?: {props: PROP}[]
}
interface ITEM {
  props: PROP,
  childItems?: CHILD_ITEM[]
}

const items = computed(() => {
  if (isVertical('real_estate_agents')) {
    return [
      {
        props: {
          title: t('app.navigation_drawer.home'),
          prependIcon: "mdi-home-city",
          value: "home",
          to: localePath("/dashboard")
        },
        childItems: []
      },
      {
        props: {
          title: t('app.navigation_drawer.properties'),
          prependIcon: "mdi-home-city",
          value: "properties",
          to: localePath("/dashboard/properties")
        },
        childItems: []
      },
      {
        props: {
          title: t('app.navigation_drawer.agent'),
          value: "agent",
          prependIcon: "mdi-account-group-outline",
          to: localePath("/dashboard/agent")
        },
        childItems: []
      },
      {
        props: {
          title: t('app.navigation_drawer.online'),
          value: "online",
          prependIcon: "mdi-web",
          to: localePath("/dashboard/sites")
        },
        childItems: []
      },
    ] as ITEM[]
  } else {
    return [
      {
        props: {
          title: t('app.navigation_drawer.home'),
          prependIcon: "mdi-home-city",
          value: "home",
          to: localePath("/dashboard")
        },
        childItems: []
      },
      {
        props: {
          title: t('app.navigation_drawer.calendar'),
          prependIcon: "mdi-calendar",
          value: "calendar",
          to: localePath("/dashboard/calendar")
        },
        childItems: []
      },
      {
        props: {
          title: t('app.navigation_drawer.catalog'),
          prependIcon: "mdi-tag",
          value: "catalog",
        },
        childItems: [
          {
            props: {
              title: t("app.navigation_drawer.services"),
              prependIcon: 'mdi-cog',
              to: localePath('/dashboard/services')
            }
          },
          {
            props: {
              title: t("app.navigation_drawer.categories"),
              prependIcon: 'mdi-store',
              to: localePath('/dashboard/categories')
            }
          },
        ]
      },
      {
        props: {
          title: t('app.navigation_drawer.staff'),
          value: "staff",
          prependIcon: "mdi-account-group-outline"
        },
        childItems: [
          {
            props: {
              title: t("app.navigation_drawer.team_members"),
              prependIcon: 'mdi-cog',
              to: localePath('/dashboard/team/team-members')
            }
          }
        ]
      },
      {
        props: {
          title: t('app.navigation_drawer.online'),
          value: "online",
          prependIcon: "mdi-web",
          to: localePath("/dashboard/sites")
        },
        childItems: []
      },
      {
        props: {
          title: t('app.navigation_drawer.integrations'),
          value: "integrations",
          prependIcon: "mdi-transit-connection-variant",
          to: localePath("/dashboard/integrations")
        },
        childItems: []
      },
      {
        props: {
          title: t('app.navigation_drawer.settings'),
          value: "settings",
          prependIcon: "mdi-cog"
        },
        childItems: [
          {
            props: {
              title: t("app.navigation_drawer.personal_information"),
              prependIcon: 'mdi-account',
              to: localePath('/dashboard/account/personal-information')
            }
          },
          {
            props: {
              title: t("app.navigation_drawer.my_business"),
              prependIcon: 'mdi-store',
            },
            children: [
              {
                props: {
                  title: t("app.navigation_drawer.about"),
                  prependIcon: 'mdi-information',
                  to: localePath('/dashboard/business/about')
                }
              },
              {
                props: {
                  title: t("app.navigation_drawer.locations"),
                  prependIcon: 'mdi-map-marker',
                  to: localePath('/dashboard/business/locations')
                }
              }
            ]
          },
          {
            props: {
              title: t("app.dictionary.subscription"),
              prependIcon: 'mdi-credit-card',
              to: localePath('/dashboard/account/subscription')
            }
          },
        ]
      }
    ] as ITEM[]
  }
})

const showPrimaryList = ref(true)
const selectedItemValue = ref(null)

const currentItem = computed(() => {
  if (selectedItemValue.value === null) return {} as ITEM
  return items.value.find(i => i.props.value === selectedItemValue.value) as ITEM
})

function handlePrimaryListClick(event) {
  showPrimaryList.value = false
  selectedItemValue.value = event.id
}
</script>

<template>
  <div>
    <VList
        v-if="showPrimaryList"
        density="compact"
        nav
        :items="items"
        @click:select="handlePrimaryListClick($event)"
    />
    <VList
        v-else
        density="compact"
        nav
    >
      <VListItem prepend-icon="mdi-arrow-left" :title="currentItem.props.title" link @click="showPrimaryList=true"/>
      <template v-for="(item, i) in currentItem.childItems" :key="i">
        <VListGroup v-if="item?.children?.length" :value="item.props.title">
          <template #activator="{ props }">
            <VListItem
                v-bind="props"
                :prepend-icon="item.props.prependIcon"
                :title="item.props.title"
            />
          </template>

          <VListItem
              v-for="(childItem, j) in item.children"
              :key="j"
              v-bind="childItem.props"
          />
        </VListGroup>

        <VListItem v-else v-bind="item.props"/>
      </template>
    </VList>
  </div>

</template>

<style scoped>
a {
  color: black;
  text-decoration: none;
}
</style>