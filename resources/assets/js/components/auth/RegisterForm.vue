<template>

    <form method="post" @submit.prevent="submit">
        <div class="form-group has-feedback" :class="{ 'has-error' : errors.has('name') }" @keydown="errors.clear('name')">
            <input type="text" class="form-control" placeholder="Your name here" name="name" value="" v-model="form.name"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="help-block" v-if="errors.has('name')" v-text="errors.get('name')"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Your email here" name="email" value="" v-model="form.email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Your password here" name="password" v-model="form.password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Repeat your password here" name="form.password_confirmation" v-model="password_confirmation"/>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-1">
                <label>
                    <div class="checkbox_register icheck">
                        <label>
                            <input type="checkbox" name="form.terms">
                        </label>
                    </div>
                </label>
            </div><!-- /.col -->
            <div class="col-xs-6">
                <div class="form-group">
                    <button type="button" class="btn btn-block btn-flat" data-toggle="modal" data-target="#termsModal">Terms</button>
                </div>
            </div><!-- /.col -->
            <div class="col-xs-4 col-xs-push-1">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div><!-- /.col -->
        </div>
    </form>

</template>
<script>

//const Errors = import './Errors.js'

class Form{
    constructor(originalFields) {
      this.fields = originalFields
    }

    for (let field in originalFields){
    this{field} = originalFields[field]

    }

}


class Errors {
    /**
     * Constructor
     */
    constructor() {
      this.errors = {}
    }

    // API
    has(field) {
      return this.errors.hasOwnProperty(field)
    }

    /**
     * Retrieve the error message for a field
     * @param field
     * @returns {*}
     */
    get(field) {
      if (this.errors[field]) {
        return this.errors[field][0]
      }
    }

    /**
     * Record the new errors
     * @param errors
     */
    record(errors) {
      this.errors = errors
    }

    clear(field) {
      if (field) {
          delete this.errors[field]
          return
      }

      this.errors = {}
    }
}

export default {
  mounted() {
    console.log('Component Register Form mounted.')
  },
  data: function () {
    return {
      form: new Form{{new FormData(document.querySelector("form")}}

      errors: new Errors()
    }
  },
  methods: {
    submit() {
//      let data = new FormData(document.querySelector("form"))
//      axios.post('/register', data).then(function (response) {
      axios.post('/register', this.$data)
      .then( response => {
            console.log(response)
          // TODO: Redirect to home
        })
        .catch( error => {
            this.errors.record(error.response.data)
        })
    }
  }
}
</script>