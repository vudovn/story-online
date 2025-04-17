new DataTable("#data-table", {
    responsive: true,
    language: {
        sProcessing: "Đang xử lý...",
        sLengthMenu: "Hiển thị _MENU_ mục",
        sZeroRecords: "Không tìm thấy kết quả",
        sInfo: "Đang hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ mục",
        sInfoEmpty: "Đang hiển thị từ 0 đến 0 trong tổng số 0 mục",
        sInfoFiltered: "(lọc từ _MAX_ mục)",
        sSearch: "Tìm kiếm:",
        oPaginate: {
            sFirst: "<i data-feather='chevrons-left'></i>",
            sPrevious: "<i data-feather='chevron-left'></i>",
            sNext: "<i data-feather='chevron-right'></i>",
            sLast: "<i data-feather='chevrons-right'></i>",
        },
        oAria: {
            sSortAscending: ": Sắp xếp theo thứ tự tăng dần",
            sSortDescending: ": Sắp xếp theo thứ tự giảm dần",
        },
    },
});
