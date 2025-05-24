<template>
    <div class="dashboard">
        <el-card v-loading="loading">
            <h2 class="dashboard-title">Tổng quan hệ thống</h2>
            <div class="dashboard-cards">
                <div
                    v-for="(card, idx) in cards"
                    :key="'card-'+idx"
                    class="dashboard-card clean-card"
                >
                    <div class="card-icon-wrap" :class="'icon-bg-' + (idx % 6)">
                        <el-icon class="card-icon"><component :is="card.icon" /></el-icon>
                    </div>
                    <div class="card-info">
                        <div class="card-value">{{ card.value }}</div>
                        <div class="card-title">{{ card.title }}</div>
                    </div>
                </div>
            </div>
            <h3 class="dashboard-charts-title">Thống kê trực quan</h3>
            <div class="dashboard-charts">
                <div class="chart-row">
                    <div class="chart-card">
                        <h4>User Growth</h4>
                        <div ref="userChart" class="chart"></div>
                    </div>
                    <div class="chart-card">
                        <h4>Service Usage</h4>
                        <div ref="serviceChart" class="chart"></div>
                    </div>
                </div>
                <div class="chart-row">
                    <div class="chart-card">
                        <h4>Course Registrations</h4>
                        <div ref="courseChart" class="chart"></div>
                    </div>
                    <div class="chart-card">
                        <h4>Top 5 Courses</h4>
                        <div ref="topCourseChart" class="chart"></div>
                    </div>
                </div>
            </div>
        </el-card>
    </div>
</template>

<script setup>
import { ref, onMounted, defineComponent } from 'vue'
import { User, Service, Reading, Message } from '@element-plus/icons-vue'
import * as echarts from 'echarts'

const loading = ref(false);

const userCount = ref(150)
const serviceCount = ref(45)
const newsCount = ref(30)
const contactCount = ref(25)
const courseCount = ref(12)
const unresolvedContactCount = ref(7)
const newUsersThisMonth = ref(18)
const visits = ref(1234)
const totalStudents = ref(320)
const courseRevenue = ref('₫ 120,000,000')
const courseCompletionRate = ref('87%')

const cards = [
    { title: 'Users', value: userCount.value, icon: User },
    { title: 'Services', value: serviceCount.value, icon: Service },
    { title: 'News', value: newsCount.value, icon: Reading },
    { title: 'Contacts', value: contactCount.value, icon: Message },
    { title: 'Courses', value: courseCount.value, icon: defineComponent({ template: '<el-icon><i class="el-icon-notebook-1"></i></el-icon>' }) },
    { title: 'Unresolved Contacts', value: unresolvedContactCount.value, icon: defineComponent({ template: '<el-icon><i class="el-icon-view"></i></el-icon>' }) },
    { title: 'New Users (Month)', value: newUsersThisMonth.value, icon: defineComponent({ template: '<el-icon><i class="el-icon-user-solid"></i></el-icon>' }) },
    { title: 'Visits', value: visits.value, icon: defineComponent({ template: '<el-icon><i class="el-icon-data-analysis"></i></el-icon>' }) },
    { title: 'Total Students', value: totalStudents.value, icon: defineComponent({ template: '<el-icon><i class="el-icon-user"></i></el-icon>' }) },
    { title: 'Course Revenue', value: courseRevenue.value, icon: defineComponent({ template: '<el-icon><i class="el-icon-money"></i></el-icon>' }) },
    { title: 'Completion Rate', value: courseCompletionRate.value, icon: defineComponent({ template: '<el-icon><i class="el-icon-finished"></i></el-icon>' }) },
]

const userChart = ref(null)
const serviceChart = ref(null)
const courseChart = ref(null)
const topCourseChart = ref(null)

onMounted(() => {
    loading.value = true;
    // Simulate fetching data with a delay
    setTimeout(() => {
        try {
            // User Growth Chart
            const userChartInstance = echarts.init(userChart.value)
            userChartInstance.setOption({
                tooltip: { trigger: 'axis' },
                xAxis: { type: 'category', data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'] },
                yAxis: { type: 'value' },
                series: [{ data: [120, 132, 101, 134, 90, 150], type: 'line', smooth: true }]
            })

            // Service Usage Chart
            const serviceChartInstance = echarts.init(serviceChart.value)
            serviceChartInstance.setOption({
                tooltip: { trigger: 'item' },
                series: [{ type: 'pie', data: [{ value: 45, name: 'Active' }, { value: 20, name: 'Inactive' }] }]
            })

            // Course Registrations Chart
            const courseChartInstance = echarts.init(courseChart.value)
            courseChartInstance.setOption({
                tooltip: { trigger: 'axis' },
                xAxis: { type: 'category', data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'] },
                yAxis: { type: 'value' },
                series: [{ data: [10, 15, 8, 20, 12, 18], type: 'bar', color: '#67C23A', barWidth: 30 }]
            })

            // Top 5 Courses Chart
            const topCourseChartInstance = echarts.init(topCourseChart.value)
            topCourseChartInstance.setOption({
                tooltip: { trigger: 'axis' },
                xAxis: { type: 'category', data: ['Kế toán A', 'Thuế B', 'Excel C', 'Thực hành D', 'Chuyên sâu E'] },
                yAxis: { type: 'value' },
                series: [{ data: [32, 28, 25, 20, 18], type: 'bar', color: '#409EFF', barWidth: 30 }]
            })
        } finally {
            loading.value = false;
        }
    }, 500); // Simulate a 500ms delay
})
</script>

<style scoped>
.dashboard {
    padding: 32px 12px 12px 12px;
    background: #f5f7fa;
    min-height: 100vh;
}
.dashboard-title {
    font-size: 2rem;
    font-weight: 700;
    color: #22304a;
    margin-bottom: 28px;
    letter-spacing: 1px;
    text-align: left;
}
.dashboard-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
    margin-bottom: 36px;
    justify-content: flex-start;
}
.clean-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 12px #e0e3e8;
    padding: 18px 22px 18px 18px;
    display: flex;
    align-items: center;
    min-width: 220px;
    min-height: 90px;
    flex: 1 1 220px;
    max-width: 320px;
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
    overflow: hidden;
}
.clean-card:hover {
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 6px 24px #409eff22;
}
.card-icon-wrap {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
}
.icon-bg-0 { background: linear-gradient(135deg, #409EFF 60%, #66b1ff 100%); color: #fff; }
.icon-bg-1 { background: linear-gradient(135deg, #67C23A 60%, #b7ffea 100%); color: #fff; }
.icon-bg-2 { background: linear-gradient(135deg, #E6A23C 60%, #fceabb 100%); color: #fff; }
.icon-bg-3 { background: linear-gradient(135deg, #F56C6C 60%, #ffd6e0 100%); color: #fff; }
.icon-bg-4 { background: linear-gradient(135deg, #909399 60%, #d1fdff 100%); color: #fff; }
.icon-bg-5 { background: linear-gradient(135deg, #8e54e9 60%, #4776e6 100%); color: #fff; }
.card-info {
    flex: 1;
}
.card-value {
    font-size: 2.1rem;
    font-weight: bold;
    color: #22304a;
    margin-bottom: 2px;
}
.card-title {
    font-size: 1.05rem;
    color: #888;
    font-weight: 500;
}
.dashboard-charts-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #22304a;
    margin-bottom: 18px;
    margin-top: 12px;
}
.dashboard-charts {
    width: 100%;
}
.chart-row {
    display: flex;
    gap: 24px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}
.chart-card {
    flex: 1 1 320px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 12px #e0e3e8;
    padding: 22px 16px 16px 16px;
    min-width: 320px;
    min-height: 320px;
    display: flex;
    flex-direction: column;
}
.chart-card h4 {
    margin-bottom: 16px;
    color: #409EFF;
    font-size: 1.08rem;
    font-weight: 600;
}
.chart {
    flex: 1;
    min-height: 220px;
}
@media (max-width: 1200px) {
    .dashboard-cards {
        gap: 12px;
    }
    .chart-row {
        gap: 12px;
    }
    .chart-card {
        min-width: 220px;
        min-height: 220px;
        padding: 10px 6px 6px 6px;
    }
    .card-icon-wrap {
        width: 36px;
        height: 36px;
        margin-right: 10px;
    }
    .card-icon {
        font-size: 24px;
    }
    .card-value {
        font-size: 1.2rem;
    }
}
@media (max-width: 900px) {
    .dashboard {
        padding: 8px;
    }
    .dashboard-cards {
        gap: 6px;
    }
    .chart-row {
        gap: 6px;
        margin-bottom: 10px;
    }
    .chart-card {
        min-width: 0;
        min-height: 120px;
        padding: 6px 2px 2px 2px;
    }
    .card-icon-wrap {
        width: 28px;
        height: 28px;
        margin-right: 6px;
    }
    .card-icon {
        font-size: 16px;
    }
    .card-value {
        font-size: 0.9rem;
    }
}
</style> 