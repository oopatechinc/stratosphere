<template>
<div>
  <v-list subheader two-line rounded elevation="2" class="wrapper">
    <h3 class="px-4 pt-4">Latest Users</h3>

    <div v-if="isLoading">
      <v-skeleton-loader
          type="article"
          loading
          class="mt-4"
      ></v-skeleton-loader>
      <v-skeleton-loader
          type="article"
          loading
          class="mt-4"
      ></v-skeleton-loader>
    </div>

    <v-list-item v-for="user in users" :key="user.id" v-else-if="!isLoading && users.length > 0">
      <v-list-item-avatar>
        <v-img :src="user.image_url"></v-img>
      </v-list-item-avatar>

      <v-list-item-content>
        <v-list-item-title v-text="user.full_name"></v-list-item-title>

        <v-list-item-subtitle v-text="formatDate(user.created_at)"></v-list-item-subtitle>
      </v-list-item-content>

      <v-list-item-action>
        <v-btn rounded elevation="1" @click="setCurrentUser(user)">View</v-btn>
      </v-list-item-action>
    </v-list-item>

    <div v-else class="px-4 mt-3"><i>No new appointments</i></div>
  </v-list>

  <v-dialog width="1111" v-model="showClientDialog">
    <Client :existing-client="currentClient" @hideDialog="showClientDialog=false" />
  </v-dialog>
</div>
</template>

<script>
    import {mapGetters, mapActions, mapMutations} from 'vuex';
    import ClientService from "@/services/client.service";
    import {formatDate} from "@/utils/utils";
    import Client from "@/views/Client";

    export default {
        name: 'LatestUsers',
      components: {Client},
      data() {
            return {
              users: [],
              currentClient: {},
              showClientDialog: false,
              isLoading: false
            }
        },

        computed: {
            ...mapGetters('business', {
                roles: 'roles',
                isLoadingBusinessRoles: 'isLoadingRoles'
            }),

        },
        methods: {
            ...mapMutations('consultants', {
                updateConsultantById: 'updateConsultantById',
                removeMerchant: 'removeMerchant',
                removeConsultantService: 'removeConsultantService'
            }),
            ...mapActions('business', {
                getRoles: 'getRoles',
            }),
          formatDate(value) {
              return formatDate(value)
          },
          setCurrentUser(user) {
            this.currentClient = user
            this.showClientDialog = true
          }
        },
        async beforeMount() {
          this.isLoading = true
          this.users = await ClientService.getClients('?filterByBusiness&sort=desc&limit=10')
          this.isLoading = false
        }
    }
</script>

<style scoped>
  .wrapper {
    height: 350px;
    overflow-y: scroll;
  }
</style>
