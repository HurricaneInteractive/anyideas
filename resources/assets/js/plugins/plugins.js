/** @ignore  */
import Vue from 'vue'

const plugins = [
    'capitalise', 'classNames', 'vue-anime'
]

const registerPlugins = () => {
    plugins.forEach(plugin => {
        Vue.use(require(`./${plugin}.js`))
    });
}

export default registerPlugins