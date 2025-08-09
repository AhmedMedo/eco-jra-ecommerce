<?php $__env->startSection('title', 'Marketplace'); ?>
<?php $__env->startSection('page_title', 'Marketplace'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6" x-data="{ view: 'grid', showFilters: false, showCalc: false }">
  <div class="flex items-center justify-between mb-6">
    <div class="flex items-center space-x-4">
      <button @click="view='list'" :class="view==='list' ? 'bg-primary-teal text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="p-2 rounded-lg">List</button>
      <button @click="view='grid'" :class="view==='grid' ? 'bg-primary-teal text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="p-2 rounded-lg">Grid</button>
      <h1 class="text-xl font-semibold text-gray-900">IREC Marketplace</h1>
    </div>
    <div class="flex items-center space-x-3">
      <button @click="showFilters = !showFilters" class="btn-secondary">Filter</button>
      <button @click="showCalc = true" class="btn-primary">Calculator</button>
    </div>
  </div>

  <div x-show="showFilters" x-cloak class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Price Range (EGP)</label>
        <div class="flex space-x-2">
          <input type="number" placeholder="Min" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-teal focus:border-transparent" />
          <input type="number" placeholder="Max" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-teal focus:border-transparent" />
        </div>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Vintage Year</label>
        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-teal focus:border-transparent">
          <option value="">All</option>
          <option>2023</option>
          <option>2024</option>
          <option>2025</option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-teal focus:border-transparent">
          <option value="">All</option>
          <option>Egypt</option>
          <option>UAE</option>
          <option>Saudi Arabia</option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Certification</label>
        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-teal focus:border-transparent">
          <option value="">All</option>
          <option>IREC</option>
          <option>I-REC</option>
        </select>
      </div>
    </div>
  </div>

  <div x-show="view==='grid'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php for($i=1; $i<=6; $i++): ?>
      <div class="project-card">
        <div class="relative h-48 bg-gradient-to-br from-orange-400 to-orange-600 overflow-hidden">
          <img src="https://images.pexels.com/photos/9800029/pexels-photo-9800029.jpeg?w=500&h=300&fit=crop" alt="Project" class="w-full h-full object-cover" />
          <div class="absolute top-4 left-4">
            <span class="bg-black bg-opacity-30 text-white px-2 py-1 rounded text-xs">2024 Vintage</span>
          </div>
        </div>
        <div class="p-6">
          <h3 class="text-lg font-semibold text-gray-900 mb-2">Benban Solar Park</h3>
          <div class="flex items-center justify-between mb-4">
            <div>
              <p class="text-sm text-gray-600">Available</p>
              <p class="text-lg font-semibold text-gray-900">1,500 MWh</p>
            </div>
            <div class="text-right">
              <p class="text-sm text-gray-600">Price</p>
              <p class="text-lg font-semibold text-gray-900">EGP 45.2 /MWh</p>
              <p class="text-xs text-gray-500">(VAT Incl.)</p>
            </div>
          </div>
          <button class="w-full btn-primary">Buy Now</button>
        </div>
      </div>
    <?php endfor; ?>
  </div>

  <div x-show="view==='list'" class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="table-header">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Country</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacity</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php for($i=1; $i<=8; $i++): ?>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary-teal">IREC-2023000<?php echo e($i); ?></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Benban Solar Park</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Egypt</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Solar</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1,500 MWh</td>
            <td class="px-6 py-4 whitespace-nowrap"><span class="status-badge status-active">Active</span></td>
          </tr>
          <?php endfor; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div x-show="showCalc" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
      <div class="p-6">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-900">Calculate Your IREC Requirements</h2>
          <button @click="showCalc=false" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
          <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Annual Energy Consumption</h3>
            <div class="flex">
              <input type="number" placeholder="Enter amount" class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-primary-teal focus:border-transparent" />
              <select class="px-4 py-3 border border-l-0 border-gray-300 rounded-r-lg bg-yellow-50 focus:ring-2 focus:ring-primary-teal focus:border-transparent">
                <option>kWh</option>
                <option>MWh</option>
                <option>GWh</option>
              </select>
            </div>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Region</h3>
            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-teal focus:border-transparent">
              <option value="">Select Region</option>
              <option>Middle East</option>
              <option>North Africa</option>
              <option>Europe</option>
              <option>Asia</option>
            </select>
          </div>
        </div>
        <div class="bg-yellow-50 rounded-lg p-6 mb-6">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Estimated IREC Requirements</h3>
          <div class="bg-primary-teal rounded-full h-3 mb-4"></div>
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-600">Based on your input</p>
              <p class="text-2xl font-bold text-gray-900">650 MWh</p>
            </div>
            <div class="text-right">
              <p class="text-sm text-gray-600">Offset CO₂</p>
              <p class="text-2xl font-bold text-gray-900">325 tons</p>
            </div>
          </div>
        </div>
        <div class="flex justify-center">
          <button class="btn-primary">Browse IRECs</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('plugin/multivendor::seller.v2.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/medo/work/eco-jara/fashly/plugins/multivendor/views/seller/v2/pages/marketplace.blade.php ENDPATH**/ ?>