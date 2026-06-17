<script setup lang="ts">
import {useSanctumClient} from "#imports";

const {t} = useI18n()
const client = useSanctumClient()
const stats = await client<[{day: string, amount: string}]>('stats?type=appointment-income&start_date=2026-04-20&end_date=2026-04-30')


const filters = [
  {
    id: 'week',
    title: t('app.dictionary.week'),
    text: t('app.dashboard.sales_chart.filters.1.text')
  },
  {
    id: 'month',
    title: t('app.dictionary.month'),
    text: t('app.dashboard.sales_chart.filters.2.text')
  },
  {
    id: '3_months',
    title: t('app.dashboard.sales_chart.filters.3.title'),
    text: t('app.dashboard.sales_chart.filters.3.text')
  }
]

const currentFilter = ref(filters[0])

const chartOptions = computed(() => {
  const filter = filters.find(f => f.id === currentFilter.value!.id)
  return {
    title: {
      text: filter?.text,
      left: 'center',
    },
    tooltip: {
      trigger: 'axis'
    },
    xAxis: {
      type: 'category',
          data: stats.map(s => s.day),
          boundaryGap: [0, 0.01]
    },
    yAxis: {
      type: 'value',
    },
    series: [
      {
        data: stats.map(s => s.amount),
        type: 'bar',
        itemStyle: {
          color: '#4ade80' // Nuxt green!
        },
        label: {
          show: true,
          formatter: (params) => `$${params.value}`
        }
      }
    ]
  }
})

</script>

<template>
<div class="chart-container">
  <div class="d-flex justify-end">
    <VSelect
        v-model="currentFilter"
        :items="filters"
        max-width="150"
        variant="filled"
        label="Filter"
        return-object
    />
  </div>
    <VChart :option="chartOptions" autoresize />
</div>
</template>

<style scoped>
.chart-container {
    height: 400px;
    width: 100%;
}
</style>