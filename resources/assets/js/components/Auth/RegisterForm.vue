<template>
    <div>
        <form method="post" @submit.prevent>
            <input type="hidden" name="_token" value="">

            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder=""></span>
            </div>

            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder=""></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder=""></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder=""></span>
            </div>

            <div class="row">
                <div class="col-xs-1">
                    <label>
                        <div class="checkbox_register icheck">
                            <label>
                                <input type="checkbox" name="terms">
                            </label>
                        </div>
                    </label>
                </div><!-- /.col -->
                <div class="col-xs-6">
                    <div class="form-group">
                        <button type="button" class="btn btn-block btn-flat" data-toggle="modal" data-target="#termsModal">asd</button>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4 col-xs-push-1">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">SUBMIT</button>
                </div><!-- /.col -->
            </div>
        </form>
    </div>
</template>
<style>
    body{
        background-color:#ff0000;
    }
</style>
<script>
    export default{
        mounted(){
        console.log("mounted component")
        },

        methods : {
           submit(){
                console.log("submit component")
           }
        },


    }
</script>
