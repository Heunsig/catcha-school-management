<template>
  <div class="ca-menu-tracker">
    <div class="__work">
      <div class="__title ca-typo-title-6">Created By</div>
      <div class="__avatar">
        <v-tooltip bottom>
          <v-avatar
            slot="activator"
            size="25"
            color="grey lighten-4"
          >
            <img :src="AVATAR_BASE_URL + '/40/' + item.created_by.full_name" alt="avatar">
          </v-avatar>
          <span>{{ item.created_by.full_name }}</span>
        </v-tooltip>
      </div>
    </div>
    <div class="__work">
      <div class="__title ca-typo-title-6">Updated By</div>
      <div class="__avatar">
        <v-tooltip bottom>
          <v-avatar
            slot="activator"
            size="25"
            color="grey lighten-4"
          >
            <img :src="AVATAR_BASE_URL + '/40/' + item.updated_by.full_name" alt="avatar">
          </v-avatar>
          <span>{{ item.updated_by.full_name }}</span>
        </v-tooltip>
      </div>
    </div>
    <div class="__work" v-if="item.deleted_by">
      <div class="__title ca-typo-title-6">Deleted By</div>
      <div class="__avatar">
        <v-tooltip bottom>
          <v-avatar
            slot="activator"
            size="25"
            color="grey lighten-4"
          >

            <img :src="AVATAR_BASE_URL + '/40/' + item.deleted_by.full_name" alt="avatar">
          </v-avatar>
          <span>{{ item.deleted_by.full_name }}</span>
        </v-tooltip>  
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: [
    'item'
  ]
}
</script>