import Vue from 'vue'

const classNames = (conditions) => {
    let classname = conditions.map(c => {
        if (typeof c === 'string') {
            if (c.trim() !== '') {
                return c.trim()
            }
        }
        else {
            if (c.hasOwnProperty('class') && c.hasOwnProperty('if')) {
                return c.if ? c.class.trim() : ''
            }
        }

        return ''
    })

    return classname.join(' ').trim();
}

export default {
    classNames,
    install(Vue, options) {
        Vue.prototype.$classNames = classNames
    }
}