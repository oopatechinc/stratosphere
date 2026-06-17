import type { WebsiteTemplate } from '~/types'
import { useSanctumClient } from '#imports'

export const useWebsiteTemplatesService = () => {
  const client = useSanctumClient()

  async function fetch(params = '') {
    return await client<WebsiteTemplate[]>(`/website-templates?${params}`) as WebsiteTemplate[]
  }

  return { fetch }
}
