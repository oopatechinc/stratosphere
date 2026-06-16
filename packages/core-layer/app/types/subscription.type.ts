import type { Plan } from './plan.type'

export type Subscription = {
  id: number
  tenant_id: number
  user_id: number
  plan_id: number
  pay_fac_subscription_id?: string
  payment_status: string
  currency: string
  tax: number
  total: number
  plan: Plan
}
