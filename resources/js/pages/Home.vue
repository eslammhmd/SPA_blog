<template>
<div class="row mt-5">
    <div class="d-flex justify-content-center align-items-center flex-column home-page">
        <h5>Over 3 million ready-to-work creatives!</h5>
        <h2>The world’s destination for design</h2>
        <p>
            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
        </p>
       <button><RouterLink :to="{name:'Blog'}">Get Started</RouterLink></button>
    </div>
</div>
</template>


<script >
export default{

    emits:['updateSidebar'],
}
</script>
