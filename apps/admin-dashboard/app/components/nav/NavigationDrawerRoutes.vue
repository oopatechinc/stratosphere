<script setup lang="ts">
const showPrimaryList = ref(true)
const selectedItemValue = ref()

const tenant = useTenant()
const menuRegistry = useMenuRegistry()

const {t} = useI18n()
const localePath = useLocalePath()

const items = computed(() => {
  const baseMenus = menuRegistry.value.global || []
  const verticalMenus = menuRegistry.value[tenant.value.id] || []

  return [...baseMenus, ...verticalMenus]

})

const currentItem = computed(() => {
  if (selectedItemValue.value === null) return {} as ITEM
  return items.value.find(i => i.props.feature === selectedItemValue.value) as ITEM
})

function handlePrimaryListClick(item: ITEM) {
  if (!item.childItems?.length) return
  showPrimaryList.value = false
  selectedItemValue.value = item.props.feature
}
</script>

<template>
  <div>
    <VList
        v-if="showPrimaryList"
        density="compact"
        :items="items"
    >
      <VListItem
          v-for="item in items"
          :prependIcon="item.props.prependIcon"
          :title="$t(item.props.titleKey)"
          :to="item.props.to ? localePath(item.props.to): undefined"
          link
          nav
          @click="handlePrimaryListClick(item)"

      />
    </VList>
    <VList
        v-else
        density="compact"
        nav
    >
      <VListItem prepend-icon="mdi-arrow-left" :title="t(currentItem.props.titleKey)" link @click="showPrimaryList=true"/>
      <template v-for="(item, i) in currentItem.childItems" :key="i">
        <VListGroup v-if="item?.children?.length" :value="t(currentItem.props.titleKey)">
          <template #activator="{ props }">
            <VListItem
                v-bind="props"
                :prepend-icon="item.props.prependIcon"
                :title="t(currentItem.props.titleKey)"
            />
          </template>

          <VListItem
              v-for="(childItem, j) in item.children"
              :key="j"
              v-bind="childItem.props"
              :title="t(childItem.props.titleKey)"
          />
        </VListGroup>

        <VListItem
            v-else
            v-bind="item.props"
            :title="t(item.props.titleKey)"
        />
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