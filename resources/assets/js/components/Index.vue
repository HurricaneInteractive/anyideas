<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">App.vue Component</div>

                    <div class="card-body">
                        <p> weirdo, you own a .... car</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        mounted() {
            console.log('index.vue mounted');
        }
        // data() {
        //     return {
        //         car_name: 'Nissan Cube'
        //     }
        // }
    }
</script>