/**
 * Loads in any components in the current directory and its subdirectories
 * 
 * Filename must begin with _global and end in a .vue extension
 * eg: _global-loading.vue
 * 
 * This will translate to a component of <GlobalLoading />
 */

import Vue from 'vue'
import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'

const RegisterGlobals = () => {
    const requireComponent = require.context('.', true, /_global-[\w-]+\.vue$/)
    
    requireComponent.keys().forEach(fileName => {
        const componentConfig = requireComponent(fileName)
        const componentName = upperFirst(
            camelCase(fileName.replace(/^\.\/_/, '').replace(/\.\w+$/, ''))
        )
    
        Vue.component(componentName, componentConfig.default || componentConfig)
    })
}

export default RegisterGlobals