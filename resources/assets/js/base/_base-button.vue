<template>
    <fragment v-if="!to">
        <button :class="classes">
            {{ text }}
            <template v-if="loading"><GlobalLoading :height="loaderConfig.height" :width="loaderConfig.width" :fill="fill" /></template>
        </button>
    </fragment>
    <fragment v-else>
        <router-link :to="to" :class="classes">
            {{ text }}
            <template v-if="loading"><GlobalLoading :height="loaderConfig.height" :width="loaderConfig.width" :fill="fill" /></template>
        </router-link>
    </fragment>
</template>

<style lang="scss" scoped>
    @import '~@/setup/_colors.scss';
    $shadow: 0 3px 6px 0 rgba(get-color('black'), 0.16);
    $padding: 12px 25px;
    $font-size: 1em;
    $font-family: inherit;
    $font-weight: normal;
    $border-radius: 200px;

    .btn {
        -webkit-appearance: none;
        padding: $padding;
        margin: 0;
        border-radius: $border-radius;
        font-size: $font-size;
        font-weight: $font-weight;
        font-family: inherit;
        display: inline-block;
        border: none;
        cursor: pointer;
        text-decoration: none;
        position: relative;
        text-align: center;
        &.btn-default {
            background: get-color('pure');
            color: get-color('black');
            border: 1px solid get-color('black');
        }
        &.btn-primary {
            background: get-color('primary');
            color: get-color('pure');
            &.btn-default {
                border-color: get-color('pure');
            }
        }
        &.btn-raised {
            border: none;
            box-shadow: $shadow;
        }
        &.btn-loading {
            color: transparent;
            .loader {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                opacity: 1;
            }
        }
    }
</style>

<script>
    export default {
        name: "BaseButton",
        data() {
            return {
                loaderConfig: {
                    width: '30px',
                    height: '30px'
                }
            }
        },
        props: {
            text: {
                type: String,
                default: 'Click me!'
            },
            classNames: {
                type: String,
                default: ''
            },
            type: {
                type: String,
                default: 'default'
            },
            raised: {
                type: Boolean,
                default: false
            },
            to: { default: false },
            loading: { type: Boolean, default: false }
        },
        computed: {
            classes() {
                let classes = this.$classNames([
                    'btn',
                    this.classNames,
                    {
                        'class': `btn-${this.type}`,
                        'if': this.type.trim() !== ''
                    },
                    {
                        'class': 'btn-raised',
                        'if': this.raised
                    },
                    {
                        'class': 'btn-loading',
                        'if': this.loading
                    }
                ]);

                return classes
            },
            fill() {
                return this.type === 'primary' ? '#FFF' : '#000'
            }
        }
    }
</script>
