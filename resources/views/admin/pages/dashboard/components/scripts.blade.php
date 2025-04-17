@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.40.0/dist/apexcharts.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Kiểm tra xem thư viện ApexCharts đã được tải hay chưa
            if (typeof ApexCharts === 'undefined') {
                console.error('ApexCharts library not loaded. Charts will not render.');
                const chartContainers = document.querySelectorAll('[id$="-chart"]');
                chartContainers.forEach(container => {
                    container.innerHTML = '<div class="alert alert-warning">Chart library failed to load. Please refresh the page or check your internet connection.</div>';
                });
                return;
            }

            // Dữ liệu biểu đồ
            const registrationData = @json($registrationData);
            const activityData = @json($activityData);
            const labels = @json($labels);

            // Biểu đồ đăng ký người dùng
            renderUserRegistrationChart(registrationData, labels);

            // Biểu đồ hoạt động đọc
            renderReadingActivityChart(activityData, labels);

            // Biểu đồ phân loại danh mục
            renderCategoryChart();
        });

        // Biểu đồ đăng ký người dùng
        function renderUserRegistrationChart(data, labels) {
            const chartElement = document.getElementById('user-registration-chart');

            if (!chartElement) {
                console.error('User registration chart container not found');
                return;
            }

            if (!data || data.length === 0 || data.every(value => value === 0)) {
                chartElement.innerHTML = '<div class="alert alert-info">No user registration data available for the last 7 days.</div>';
                return;
            }

            const options = {
                series: [{
                    name: 'New Users',
                    data: data
                }],
                chart: {
                    type: 'bar',
                    height: 320,
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#4680ff'],
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '45%',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: labels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    title: {
                        text: 'Number of New Users'
                    },
                    min: 0, // Bắt đầu từ 0
                    forceNiceScale: true,
                    labels: {
                        formatter: function (val) {
                            return Math.floor(val); // Chỉ hiển thị số nguyên
                        }
                    }
                },
                grid: {
                    strokeDashArray: 4
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " users"
                        }
                    }
                },
                responsive: [{
                    breakpoint: 576,
                    options: {
                        chart: {
                            height: 250
                        }
                    }
                }]
            };

            try {
                const chart = new ApexCharts(chartElement, options);
                chart.render();
            } catch (error) {
                console.error('Error rendering user registration chart:', error);
                chartElement.innerHTML = '<div class="alert alert-danger">Error rendering chart. Please try again later.</div>';
            }
        }

        // Biểu đồ hoạt động đọc
        function renderReadingActivityChart(data, labels) {
            const chartElement = document.getElementById('reading-activity-chart');

            if (!chartElement) {
                console.error('Reading activity chart container not found');
                return;
            }

            if (!data || data.length === 0 || data.every(value => value === 0)) {
                chartElement.innerHTML = '<div class="alert alert-info">No reading activity data available for the last 7 days.</div>';
                return;
            }

            const options = {
                series: [{
                    name: 'Reading Sessions',
                    data: data
                }],
                chart: {
                    type: 'line',
                    height: 320,
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#2ca87f'],
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                dataLabels: {
                    enabled: false
                },
                markers: {
                    size: 5,
                    strokeWidth: 2,
                    hover: {
                        size: 7
                    }
                },
                xaxis: {
                    categories: labels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    title: {
                        text: 'Reading Sessions'
                    },
                    min: 0,
                    forceNiceScale: true,
                    labels: {
                        formatter: function (val) {
                            return Math.floor(val);
                        }
                    }
                },
                grid: {
                    strokeDashArray: 4
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " sessions"
                        }
                    }
                },
                responsive: [{
                    breakpoint: 576,
                    options: {
                        chart: {
                            height: 250
                        }
                    }
                }]
            };

            try {
                const chart = new ApexCharts(chartElement, options);
                chart.render();
            } catch (error) {
                console.error('Error rendering reading activity chart:', error);
                chartElement.innerHTML = '<div class="alert alert-danger">Error rendering chart. Please try again later.</div>';
            }
        }

        // Biểu đồ phân loại danh mục
        function renderCategoryChart() {
            const chartElement = document.getElementById('category-chart');

            if (!chartElement) {
                console.error('Category chart container not found');
                return;
            }

            // Chuẩn bị dữ liệu danh mục
            const categories = @json($categories);

            if (!categories || categories.length === 0) {
                chartElement.innerHTML = '<div class="alert alert-info">No category data available.</div>';
                return;
            }

            const categoryNames = [];
            const categoryData = [];

            categories.forEach(category => {
                categoryNames.push(category.name);
                categoryData.push(category.stories_count);
            });

            if (categoryData.every(value => value === 0)) {
                chartElement.innerHTML = '<div class="alert alert-info">All categories have 0 stories.</div>';
                return;
            }

            const options = {
                series: categoryData,
                labels: categoryNames,
                chart: {
                    type: 'donut',
                    height: 300,
                },
                colors: ['#4680ff', '#2ca87f', '#ffa21d', '#ff5252', '#7a15f7'],
                legend: {
                    show: false
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                name: {
                                    show: true
                                },
                                value: {
                                    show: true
                                },
                                total: {
                                    show: true,
                                    label: 'Total Stories',
                                    formatter: function (w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                    }
                                }
                            }
                        }
                    }
                },
                responsive: [{
                    breakpoint: 576,
                    options: {
                        chart: {
                            height: 250
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    labels: {
                                        show: false
                                    }
                                }
                            }
                        }
                    }
                }],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " stories"
                        }
                    }
                }
            };

            try {
                const chart = new ApexCharts(chartElement, options);
                chart.render();
            } catch (error) {
                console.error('Error rendering category chart:', error);
                chartElement.innerHTML = '<div class="alert alert-danger">Error rendering chart. Please try again later.</div>';
            }
        }
    </script>
@endpush