<template>
    <div class="step step-1">
        <blockquote>
            <p>“If you always do what interests you, at least one person is pleased”</p>
            <cite>KATHARINE HEPBURN</cite>
        </blockquote>
        <div class="interest-selector">
            
        </div>
        <div class="form-block">
            <div class="input-field">
                <input
                    type="email"
                    name="email"
                    id="email"
                    v-on:input="onChange"
                    :class="emailHasContent"
                    autocomplete="off"
                    autofocus
                />
                <label for="email">Email</label>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'RegisterEmail',
        props: ['email'],
        methods: {
            onChange(e) {
                this.$emit('onchange', e)
            }
        },
        computed: {
            emailHasContent: function() {
                return {
                    'has-content': this.email
                }
            }
        }
    }
</script>
