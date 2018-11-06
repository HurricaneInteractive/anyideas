## Components

### <GlobalLoading />
#### Props
- width (default: "40px")
- height (default: "40px")
- fill (default: "#000")

### <GlobalNoideas />
#### Props
`NULL`

### <GlobalEditor />
#### Props
- content (default: "")
- editing (default: true)

#### Usage
```
	<template>
		<GlobalEditor :content="content" :editing="editing" @update="updateContent" />
	</template>

	<script>
		export default {
			...
			data() {
				return {
					content: "# Hello",
					editing: false
				}
			},
			methods: {
				updateContent(content) {
					this.content = content
				}
			}
		}
	</script>
```