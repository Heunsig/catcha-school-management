<template>
  <el-form ref="form" :model="form" :rules="rules" label-position="top">
    <v-container fluid class="pa-0">
      <v-layout wrap layout>
        <v-flex xs12>
          <el-form-item label="Status" class="ca-label" prop="status">
            <el-select 
              v-model="form.status"
              clearable 
              placeholder="Please select status"
              class="ca-block"
            >
              <el-option
                v-for="item in STATUS_ITEMS"
                :key="item"
                :label="item"
                :value="item"
              >
              </el-option>
            </el-select>
          </el-form-item>
        </v-flex>
        <v-flex xs12>
          <el-form-item label="Method" class="ca-label" prop="method_key">
            <el-select 
              v-model="form.method_key"
              clearable 
              placeholder="Please select method"
              class="ca-block"
            >
              <el-option
                v-for="item in payment_methods"
                :key="item.key"
                :label="item.method"
                :value="item.key"
              >
              </el-option>
            </el-select>
          </el-form-item>
          <template v-if="form.method_key === 'CC'">
            <CreditCard
              ref="credit_card"
            ></CreditCard>
          </template>
        </v-flex>
        <v-flex xs12>
          <el-form-item label="Note" class="ca-label">
            <el-input
              type="textarea"
              :autosize="{ minRows: 6 }"
              placeholder="Please input note"
              v-model="form.note">
            </el-input>
          </el-form-item>
        </v-flex>
      </v-layout>
    </v-container>
  </el-form>
</template>
<script>
import CreditCard from './payment_method_form/CreditCard'

export default {
  components: {
    CreditCard
  },
  data: () => ({
    form: {
      status: '',
      method_key: '',
      note: ''
    },
    rules: {
      status: [
        { required: true, message: 'Please select status', trigger: 'change' }
      ],
      method_key: [
        { required: true, message: 'Please select method', trigger: 'change' }
      ]
    }
  }),
  computed: {
    payment_methods () {
      return this.$store.getters['payment/payment_methods']
    }
  },
  methods: {
    validate() {
      let $this = this
      let result = false
      this.$refs['form'].validate((valid) => {
        if (valid) {
          if (this.form.method_key === 'CC') {
            if (this.$refs['credit_card'].validate()) {
              result = $this.form
              result.details = this.$refs['credit_card'].validate()
            } else {
              result = false
            }
          } else {
            result = $this.form
          }
        } else {
          result = false
        }
      })

      return result
    },
    reset () {
      this.$refs['form'].resetFields()
    }
  }
}
</script>