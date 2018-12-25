<template>
  <el-form ref="form" :model="form" :rules="rules" label-position="top">
    <v-container fluid class="pa-0">
      <v-layout wrap>
        <v-flex xs12>
          <el-form-item label="The last 4 digits" class="ca-label" prop="digits">
            <el-input 
              placeholder="Please input the last 4 digits" 
              v-model="form.digits"
              maxlength="4"
            ></el-input>
          </el-form-item>
        </v-flex>
        <v-flex xs12>
          <el-form-item label="Name on card" class="ca-label" prop="name">
            <el-input placeholder="Please input name on the card" v-model="form.name"></el-input>
          </el-form-item>
        </v-flex>
        <v-flex xs12>
          <el-form-item label="Expiration Date(MM/YY)" class="ca-label" prop="date">
            <el-input 
              v-model="form.date"
              placeholder="Month/Year"
              v-mask="'##/##'"
            ></el-input>
          </el-form-item>
        </v-flex>
      </v-layout>
    </v-container>
  </el-form>
</template>
<script>
export default {
  data: () => ({
    form: {
      digits: '',
      name: '',
      date: ''
    },
    rules: {
      digits: [
        { 
          required: true, 
          message: 'Please input the last 4 digits on the card.',
          trigger: 'blur'
        }
      ],
      name: [
        {
          required: true, 
          message: 'Please input the name on the card.',
          trigger: 'blur'
        }
      ],
      date: [
        {
          required: true, 
          message: 'Please input the expiration date on the card.',
          trigger: 'blur'
        }
      ]
    }
  }),
  methods: {
    validate() {
      let $this = this
      let result = false
      this.$refs['form'].validate((valid) => {
        if (valid) {
          result = $this.form
        } else {
          result = false
        }
      })

      return result
    }
  }
}
</script>