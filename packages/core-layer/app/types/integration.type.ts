import type {IntegrationResource} from "./integration-resource.type";
import type {IntegrationEvent} from "./integration-event.type";

export type Integration = {
  id: number,
  integrable_id: number,
  integrable_type: string,
  platform: string,
  platform_pretty_name: string,
  primary_resource_id: string,
  status: string,
  resources: IntegrationResource[],
  events: IntegrationEvent[]
}
