<template>
  <v-card>
    <v-card-title>
      
    </v-card-title>
    <v-card-text>
      <ul class="ca-list-reset">
        <li
          v-for="student in new_students.items"
          class="my-3 insty-list-item"
        >
          <div class="mr-3">
            <v-tooltip bottom>
              <v-avatar
                slot="activator"
                size="45"
                color="grey lighten-4 ca-cursor-pointer"
                @click="$router.push({name: 'student.basic_information', params: {student_id: student.id}})"
              >
                <img :src="AVATAR_BASE_URL+'/50/'+student.full_name" :alt="student.full_name"/>
              </v-avatar>
              <span>{{ student.full_name }}</span>
            </v-tooltip>
          </div>
          <div>
            <div>
              <strong>{{ student.full_name }}</strong>
            </div>
            <div>
              <ul class="ca-metadata">
                <li class="ca-metadata-item">
                  <span class="ca-metadata-item-title">Type</span>
                  <span class="ca-metadata-item-content">{{ student.type }}</span>
                </li>
                <li class="ca-metadata-item">
                  <span class="ca-metadata-item-title">Birth Day</span>
                  <span class="ca-metadata-item-content">{{ student.birth_day }}</span>
                </li>
                <li class="ca-metadata-item">
                  <span class="ca-metadata-item-title">Email</span>
                  <span class="ca-metadata-item-content">{{ student.email }}</span>
                </li>
                <li class="ca-metadata-item">
                  <span class="ca-metadata-item-title">Created At</span>
                  <span class="ca-metadata-item-content">{{ student.created_at }}</span>
                </li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </v-card-text>
    <v-card-actions>
      <template v-if="is_no_more">
        <v-btn flat block color="orange" disabled>
          No more
        </v-btn>
      </template>
      <template v-else>
        <v-btn flat block color="orange">
          More
          <span class="ml-1" v-if="more">
          (+ {{ more }})
          </span>
        </v-btn>
      </template>
    </v-card-actions>
  </v-card>
</template>
<script>
export default {
  computed: {
    new_students () {
      return this.$store.getters['dashboard/new_students']
    },
    more () {
      return parseInt(this.new_students.count) - this.new_students.items.length
    },
    is_no_more () {
      return this.more <= 0
    }
  }
}
</script>
<style scoped>
  .insty-list-item {
    display: flex;
  }

  .ca-metadata {
    margin: 0;
    padding: 0;
    list-style: none;
  }

  .ca-metadata-item {
    display: inline-block;
    margin-right: 3px;
  }

  .ca-metadata-item:last-child {
    margin-right: 0px;
  }

  .ca-metadata-item:after {
    content: ' / ';
  }
  .ca-metadata-item:last-child:after {
    content: none;
  }

  .ca-metadata-item-title {
    color: #3c3c3c;
  }

  .ca-metadata-item-content {
    color: #979797;
  }
</style>