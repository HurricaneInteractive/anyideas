<!-- <template>
    <div class="container">
        <div class="row">
          <header>
            <h1>title</h1>
            <p>Description</p>
            <div>
              <p>Darts</p>
              <span>icon</span>
            </div>
          </header>

          <section class="meta_data">
            <ul>
              <li><router-link>Category</router-link></li>
              <li><router-link>Status</router-link></li>
              <ul>
                <li>tag</li>
                <li>items</li>
                <li>go</li>
                <li>here</li>
              </ul>
            </ul>
          </section>

          <section class="idea_navigation">
            <ul>
              <li>Description</li>
              <li>Timeline</li>
              <li>Updates</li>
            </ul>
          </section> -->

             <!-- <div class="col-md-8">
//                 <div class="card card-default">

//                   <button @click="getUser">get user data</button><br/><br/>
//                   <button @click="getUserById">get user data by id (pre-filled)</button><br/><br/>

//                   <form method="GET">
//                     <div class="form-group row">
//                       <label for="idea_id" class="col-md-4 col-form-label text-md-right">find Idea by id (e.g. 5678)</label>

//                       <div class="col-md-6">
//                         <input id="idea_id" type="text" class="form-control" v-model="idea_id" required autofocus>
//                       </div>
//                     </div>
//                     <div class="form-group row mb-0">
//                       <div class="col-md-6 offset-md-4">
//                         <button type="submit" class="btn btn-primary" @click="handleIdeaFinder">
//                           Find my idea
//                         </button>
//                       </div>
//                     </div>
//                   </form>
                  
                  
//                   <h1>{{this.ideaSingle}}</h1>
//                   <button @click="getIdeaByUser">get ideas by user id</button><br/><br/>
//                   <button @click="handldeGetSingleIdeaData">get single idea data</button><br/><br/>
//                   <button @click="handleGetIdeaData">get all idea data</button><br/><br/>
//                   <button @click="handleIdeaDelete">delete idea data (pre filled data)</button><br/><br/>
//                   <button @click="handleIdeaUpdate">update idea data (with pre filled data to update with)</button><br/><br/>
//                   <button @click="hanldeGetIdeaByTitle">get ideas by title (pre filled) idea_id</button><br/><br/>
//                   <button @click="handleGetIdeaByCategories">get ideas by category (pre filled data)</button><br/><br/>
//                   <button @click="handleGetIdeaByTags">get ideas by tags (pre filled array of data)</button><br/><br/>
//                   <hr/>
//                 </div>
//             </div> -->
//         </div>
//     </div>
// </template>

// <script>
//   import TabNav from '../components/TabNav'
//   export default {
//     components: [ TabNav ],
//     data() {
//       return {
//         idea: {
//           title: '',
//           description: '',
//           pitch: '',
//           status: '',
//           image: '',
//         },
//         ideaSingle: '',
//         idea_id: '',
//         errors: [],
//         ideas: []
//       }
//     },
//     mounted() {
//       console.log('AddNewIdea.vue page');
//     },
//     methods: {
//       // idea functions
//       getUserById(e) {
//         e.preventDefault();
//         let user_id = '1235'
//         axios({
//           method: 'POST',
//           url: '/ai/user/get/' + user_id,
//           headers: {
//             'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
//           }
//         }).then( (response) => {
//           console.log('​getUser -> response.data', response.data); 
//         });
//       },
//       getUser(e) {
//         e.preventDefault();
//         axios({
//           method: 'POST',
//           url: '/ai/user/get',
//           headers: {
//             'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
//           }
//         }).then( (response) => {
//           console.log('​getUser -> response', response); 
//         });
//       },
//       getIdeaByUser(e) {
//         e.preventDefault();
//         let userID = 1234;
//         axios({
//           method: 'POST',
//           url: '/ai/idea/get-by-user/' + userID
//         }).then( (response) => {
//         });
//       },
//       handleGetIdeaByTags(e) {
//         e.preventDefault();
//         let tag_data = ['vue', 'cheese'];
//         axios({
//           method: 'POST',
//           url: '/ai/idea/get-by-tags',
//           data: {
//             tags: tag_data
//           }
//         }).then( (response) => {
//         });
//       },
//       handleGetIdeaByCategories(e) {
//         e.preventDefault();
//         let category_data = 'Web App' ;
//         axios({
//           method: 'POST',
//           url: '/ai/idea/get-by-category/' + category_data,
//         }).then( (response) => {
//         });
//       },
//       hanldeGetIdeaByTitle(e) {
//         e.preventDefault();
//         let idea_title = 'any.ideas.v2';
//         axios({
//           method: 'POST',
//           url: '/ai/idea/get-by-title/' + idea_title,
//         }).then( (response) => {
//         });
//       },
//       handleIdeaUpdate(e) {
//         e.preventDefault();
//         let updateThis = '5678';
//         axios({
//           method: 'POST',
//           url: '/ai/idea/update/' + updateThis,
//           data: {
//               title: 'back 2 any ideas',
//               pitch: 're-name pitch here'
//           },
//         }).then( (response) => {
//         });
//       },
//       handleIdeaDelete(e) {
//         e.preventDefault();
//         let deleteThis = '1234';
//         axios({
//           method: 'POST',
//           url: '/ai/idea/delete/' + deleteThis,
//         }).then( (response) => {
//         });
//       },
//       handleIdeaFinder(e) {
//         e.preventDefault();
//         let goHere = this.idea_id;
//         axios({
//           method: 'POST',
//           url: '/ai/idea/get/' + goHere,
//         }).then( (response) => {
//           console.log('​handleIdeaFinder -> response', response);
//           if (response.data === "") {
//             alert('there is no idea with that ID');
//           }
//           this.ideaSingle = response.data.title;
//         });
//       },
//       handldeGetSingleIdeaData(e) {
//         let goHere = '5678';
//         axios({
//           method: 'POST',
//           url: '/ai/idea/get/' + goHere,
//         }).then( (response) => {
//           this.ideaSingleData = response.data
//         });

//       },

//       // on click gets ideas data and console logs them
//       handleGetIdeaData(e) {
//         e.preventDefault()
//         axios({
//           method: 'POST',
//           url: '/ai/idea/get/all',
//         }).then( (response) => {
//         });
//       },
//     }
//   }
// </script>