<template>
  <div class="lg:w-2/3 w-full bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">

    <!-- Header -->
    <section id="products-all" class="admin-section">
      <div class="flex items-center justify-between p-4 bg-gray-100 border-b border-gray-200">
        <h1 class="text-2xl font-bold text-gray-800">
          جميع المنتجات
        </h1>
        <button
          @click="openAddModal"
          class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 flex items-center justify-center text-sm"
        >
          <svg class="h-4 w-4 ml-2 rtl:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
          إضافة منتج جديد
        </button>
      </div>

      <!-- Search -->
      <div class="p-4">
        <input
          type="search"
          v-model="search"
          placeholder="ابحث عن ما تريد ..."
          class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64"
        />
      </div>

      <!-- Table -->
      <div class="overflow-x-auto" style="padding:10px">
        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-sm">
          <thead>
            <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-right">
              <th class="py-2 px-4">#</th>
              <th class="py-2 px-4">المنتج</th>
              <th class="py-2 px-4">السعر</th>
              <th class="py-2 px-4">SKU</th>
              <th class="py-2 px-4">التقييم</th>
              <th class="py-2 px-4">الحالة</th>
              <th class="py-2 px-4">إجراءات</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="filteredProducts.length === 0">
              <td colspan="7" class="text-center py-5 text-gray-500">لا توجد منتجات</td>
            </tr>
            <tr v-for="(product, index) in filteredProducts" :key="product.id">
              <td class="text-center">{{ index + 1 }}</td>
              <td class="text-center">{{ product.title }}</td>
              <td class="text-center">{{ product.price }}</td>
              <td class="text-center">{{ product.sku }}</td>
              <td class="text-center">{{ product.rate }}</td>
              <td class="text-center">
                <span
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                  :class="product.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'"
                >
                  {{ product.status }}
                </span>
              </td>
              <td class="text-center">
                <button @click="openEditModal(product)" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 mr-2">
                  تعديل
                </button>
                <button @click="deleteProduct(product.id)" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">
                  حذف
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Modal -->
    <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-96">
        <h2 class="text-lg font-bold mb-4">{{ isEdit ? 'تعديل المنتج' : 'إضافة منتج جديد' }}</h2>
        <div class="space-y-3">
          <input v-model="form.title" placeholder="اسم المنتج" class="w-full px-3 py-2 border rounded-md" />
          <input v-model="form.price" placeholder="السعر" type="number" class="w-full px-3 py-2 border rounded-md" />
          <input v-model="form.sku" placeholder="SKU" class="w-full px-3 py-2 border rounded-md" />
          <input v-model="form.rate" placeholder="التقييم" type="number" class="w-full px-3 py-2 border rounded-md" />
          <select v-model="form.status" class="w-full px-3 py-2 border rounded-md">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>
        <div class="flex justify-end mt-4 space-x-2 rtl:space-x-reverse">
          <button @click="saveProduct" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            {{ isEdit ? 'حفظ التعديلات' : 'إضافة' }}
          </button>
          <button @click="closeModal" class="bg-gray-300 px-4 py-2 rounded-md hover:bg-gray-400">
            إلغاء
          </button>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'

// reactive variables
const products = ref([])
const showModal = ref(false)
const isEdit = ref(false)
const form = ref({ id: null, title: '', price: 0, sku: '', rate: 0, status: 'active' })
const search = ref('')

// Lifecycle hook: fetch products
onMounted(async () => {
  await fetchProducts()
})

// computed: filtered products
const filteredProducts = computed(() => {
  if (!search.value) return products.value
  return products.value.filter(p =>
    p.title.toLowerCase().includes(search.value.toLowerCase())
  )
})

// Methods
async function fetchProducts() {
  const res = await axios.get('test/api/v1/products')
  products.value = res.data
}

function openAddModal() {
  isEdit.value = false
  form.value = { id: null, title: '', price: 0, sku: '', rate: 0, status: 'active' }
  showModal.value = true
}

function openEditModal(product) {
  isEdit.value = true
  form.value = { ...product }
  showModal.value = true
}

function closeModal() {
  showModal.value = false
}

async function saveProduct() {
  if (isEdit.value) {
    // تحديث
    await axios.put(`/api/v1/products/${form.value.id}`, form.value)
  } else {
    // إضافة
    await axios.post('/api/v1/products', form.value)
  }
  await fetchProducts()
  closeModal()
}

async function deleteProduct(id) {
  if (!confirm('هل أنت متأكد من حذف هذا المنتج؟')) return
  await axios.delete(`/api/v1/products/${id}`)
  await fetchProducts()
}
</script>

<style scoped>
/* Optional: تحسين ظهور modal */
</style>
