<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page_title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-primary-teal">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-600">Total Certificates Listed</p>
          <p class="text-2xl font-bold text-gray-900 mt-1">3,500</p>
          <p class="text-xs text-gray-500 mt-1">MW</p>
        </div>
      </div>
      <div class="flex items-center mt-3"><span class="text-green-600 text-sm font-medium">+12.5%</span></div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-600">Revenue Generated</p>
          <p class="text-2xl font-bold text-gray-900 mt-1">175,000</p>
          <p class="text-xs text-gray-500 mt-1">EGP</p>
        </div>
      </div>
      <div class="flex items-center mt-3"><span class="text-red-600 text-sm font-medium">-3.2%</span></div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-600">Market Share</p>
          <div class="relative w-16 h-16 mt-2">
            <canvas id="miniPie" width="64" height="64"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-purple-500">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-600">Approval Rate</p>
          <div class="relative w-16 h-16 mt-2">
            <canvas id="miniPie2" width="64" height="64"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-sm p-6">
      <h3 class="text-lg font-semibold text-gray-900 mb-4">Energy Distribution</h3>
      <div class="h-64"><canvas id="pieChart"></canvas></div>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-6">
      <h3 class="text-lg font-semibold text-gray-900 mb-4">Monthly Activity</h3>
      <div class="h-64"><canvas id="lineChart"></canvas></div>
    </div>
  </div>

  <div x-data="{ tab: 'project' }" class="bg-white rounded-lg shadow-sm">
    <div class="px-6 py-4 border-b border-gray-200">
      <div class="flex items-center space-x-8">
        <button @click="tab='project'" :class="tab==='project' ? 'text-primary-teal border-primary-teal' : 'text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300'" class="pb-2 text-sm font-medium border-b-2">Project</button>
        <button @click="tab='transactions'" :class="tab==='transactions' ? 'text-primary-teal border-primary-teal' : 'text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300'" class="pb-2 text-sm font-medium border-b-2">Transactions</button>
      </div>
    </div>
    <div class="p-6">
      <div x-show="tab==='project'">
        <p class="text-gray-600">Project content placeholder.</p>
      </div>
      <div x-show="tab==='transactions'">
        <p class="text-gray-600">Transactions content placeholder.</p>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  (function(){
    const pieEl = document.getElementById('pieChart');
    if (pieEl) {
      new Chart(pieEl, { type: 'doughnut', data: { labels: ['Wind','Solar','Hydro','Bio'], datasets: [{ data:[11,24,26,39], backgroundColor:['#14b8a6','#f97316','#3b82f6','#22c55e'], borderWidth:0 }] }, options: { cutout: '70%', plugins: { legend: { display:false } }, maintainAspectRatio: false } });
    }
    const lineEl = document.getElementById('lineChart');
    if (lineEl) {
      new Chart(lineEl, { type: 'line', data: { labels:['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'], datasets:[{ data:[3,4,3.5,5,4.5,4,4.5,5.5,4,3.5,4,5], borderColor:'#14b8a6', backgroundColor:'rgba(20,184,166,0.1)', borderWidth:2, fill:true, tension:0.4, pointBackgroundColor:'#14b8a6', pointBorderColor:'#fff', pointBorderWidth:2, pointRadius:4 }] }, options: { responsive:true, maintainAspectRatio:false, plugins:{ legend:{ display:false } }, scales:{ x:{ grid:{ display:false } }, y:{ beginAtZero:true, max:6, ticks:{ stepSize:1, callback:(v)=>v+'k' } } } } });
    }
    const mp1 = document.getElementById('miniPie');
    if (mp1) new Chart(mp1, { type:'doughnut', data:{ labels:['A','B'], datasets:[{ data:[28,72], backgroundColor:['#3b82f6','#e5e7eb'], borderWidth:0 }]}, options:{ cutout:'70%', plugins:{ legend:{ display:false } }}});
    const mp2 = document.getElementById('miniPie2');
    if (mp2) new Chart(mp2, { type:'doughnut', data:{ labels:['A','B'], datasets:[{ data:[83,17], backgroundColor:['#8b5cf6','#e5e7eb'], borderWidth:0 }]}, options:{ cutout:'70%', plugins:{ legend:{ display:false } }}});
  })();
</script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('plugin/multivendor::seller.v2.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/medo/work/eco-jara/fashly/plugins/multivendor/views/seller/v2/pages/dashboard.blade.php ENDPATH**/ ?>