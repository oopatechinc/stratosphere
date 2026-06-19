<script setup lang="ts">
import {storeToRefs} from "pinia"

const config = useRuntimeConfig()
const {domain, pageContent} = storeToRefs(useDomainStore())
const {fetch, getSubdomain} = useDomainStore()

const subdomain = getSubdomain()

if (subdomain === config.public.appSubdomain) {
  pageContent.value = 'underConstruction'
} else {
  await fetch(subdomain as string)
}

</script>
<template>
    <div>
    <VCard v-if="pageContent === 'loading'">
      <VCardText>
        <VSkeletonLoader
            type="card, article, card, article"
        />
      </VCardText>
    </VCard>
    <WebsiteViewer
        v-else-if="pageContent === 'website' && domain.website_id"
        :website-id="domain.website_id"
        source="frontpage"
    />
    <UnderConstruction v-else />
  </div>
</template>
