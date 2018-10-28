import Loading from './_loading'

describe('@components/_loading', () => {
  it('renders a font-awesome icon', () => {
    const { element } = mount(Loading, {
      propsData: {
        name: 'sync',
      },
    })

    expect(element.tagName).toEqual('svg')
    expect(element.classList).toContain('svg-inline--fa', 'fa-sync', 'fa-w-16')
  })

  it('renders a custom icon', () => {
    const { element } = shallowMount(Loading, {
      ...createComponentMocks({
        style: {
          iconCustomSomeIcon: 'generated-class-name',
        },
      }),
      propsData: {
        source: 'custom',
        name: 'some-icon',
      },
    })

    expect(element.className).toEqual('generated-class-name')
  })
})
