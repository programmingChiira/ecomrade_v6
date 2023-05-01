var app = new Vue({
  el: '#app',
  data: {
    average_rating: null
  },
  mounted() {
    this.getAverageRating();
  },
  methods: {
    getAverageRating() {
      axios.get('/api/average_rating')
        .then(response => {
          this.average_rating = response.data.average_rating;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
});
<div id="app">
  <p>Average rating: {{ average_rating }}</p>
</div>
axios.get('/api/average_rating')
  .then(response => {
    this.average_rating = response.data.average_rating;
  })
  .catch(error => {
    console.log(error);
  });