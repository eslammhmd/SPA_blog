<template>
   
    <Navbar />
    <!-- <router-view /> -->

    <h3>Dashboard</h3>
     <div>
        <canvas id="myChart"></canvas>
     </div>
</template>


<script>
import Navbar from './inc/Navbar.vue';
import 'https://cdn.jsdelivr.net/npm/chart.js';

export default{
    emits:['updateSidebar'],
    components: { Navbar },


    mounted() {
      this.fetchData()
  },
  methods:{
    fetchData(){
      axios.get('/api/chart_data') 
      .then(response => {
        const resData = response.data; 
        // grab data
        const categoryTitles = resData.map(category => category.name);
        const postCounts = resData.map(category => category.posts_count);
        document.getElementById('myChart');
        // console.log(postCounts)
        // console.log(categoryTitles)
      
        this.createChart(categoryTitles, postCounts);






    
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
    },

    createChart(labels, data){
      const ctx = document.getElementById('myChart');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [
          {
            label: 'Count of Items',
            data: data,
            backgroundColor: 'rgba(75, 192, 192, 0.6)', // Customize the bar color
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
              },
            },
          ],
        },
      },
    });      
    }


  }
};



    

</script>


  


  
