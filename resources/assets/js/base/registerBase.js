/**
 * Loads in any components in the current directory and its subdirectories
 * 
 * Filename must begin with _base and end in a .vue extension
 * eg: _base-button.vue
 * 
 * This will translate to a component of <BaseButton />
 */

import Vue from 'vue'
import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'

const RegisterBase = () => {
    const requireComponent = require.context('.', true, /_base-[\w-]+\.vue$/)
    
    requireComponent.keys().forEach(fileName => {
        const componentConfig = requireComponent(fileName)
        const componentName = upperFirst(
            camelCase(fileName.replace(/^\.\/_/, '').replace(/\.\w+$/, ''))
        )
    
        Vue.component(componentName, componentConfig.default || componentConfig)
    })
}

export default RegisterBase