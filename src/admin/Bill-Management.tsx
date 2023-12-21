import { useGetBillsQuery, useRemoveBillMutation } from "../api/bill";
import { Button, Table, Popconfirm } from "antd";
import { IBill } from "../interfaces/bill";
import { Link } from "react-router-dom";
import { ProductItem } from "@/interfaces/product";
import { notification } from "antd";

interface ApiResponse {
  data: IBill[]; // Adjust this based on the actual structure of your API response
  // Add other properties if necessary, e.g., meta, status, etc.
}
const BillManagement = () => {
  const { data, error } = useGetBillsQuery();
  const [removeBill] = useRemoveBillMutation();
  if (!data && !error) {
    return <div>Loading...</div>;
  }

  // Check for errors
  if (error) {
    const errorMessage =
      "message" in error ? error.message : "An error occurred";

    return <div>Error: {errorMessage}</div>;
  }

  if (error) return <div>Error</div>;
  const dataSource =
    data?.map(
      ({
        id,
        user_id,
        status,
        address,
        date,
        total,
        phone,
        payment_method,
        notes,
        products,
      }: IBill) => {
        return {
          key: id,
          user_id,
          status,
          date,
          address,
          total,
          phone,
          payment_method,
          notes,
          products,
        };
      }
    ) || [];
  const columns = [
    {
      title: "Products",
      dataIndex: "products",
      key: "products",
      render: (products: ProductItem[]) => (
        <ul>
          {products.map((product) => (
            <li key={product.id}>
              {product.name}
              <img
                src={product.img}
                alt=""
                style={{ maxWidth: "100px", maxHeight: "100px" }}
              />
            </li>
          ))}
        </ul>
      ),
    },
    {
      title: "address",
      dataIndex: "address",
      key: "address",
    },
    {
      title: "Phone",
      dataIndex: "phone",
      key: "phone",
    },
    {
      title: "Date",
      dataIndex: "date",
      key: "date",
    },
    {
      title: "Status",
      dataIndex: "status",
      key: "status",
    },
    {
      title: "payment_method",
      dataIndex: "payment_method",
      key: "payment_method",
    },
    {
      title: "notes",
      dataIndex: "notes",
      key: "notes",
    },
    {
      title: "total",
      dataIndex: "total",
      key: "total",
    },
    {
      title: "Action",
      key: "action",
      render: ({ key: id }: any) => {
        return (
          <>
            <Popconfirm
              placement="topLeft"
              title={"Bạn có muốn xóa không?"}
              onConfirm={() => xoa(id)}
              okText="Yes"
              cancelText="No"
            >
              <Button>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="10"
                  height="10"
                  fill="currentColor"
                  className="bi bi-archive"
                  viewBox="0 0 16 16"
                >
                  <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5zm13-3H1v2h14zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                </svg>
              </Button>
            </Popconfirm>
            <Button type="primary" danger className="ml-2">
              <Link to={`/admin/bill/${id}/edit`}>Edit</Link>
            </Button>
          </>
        );
      },
    },
  ];

  const xoa = async (id: any) => {
    try {
      await removeBill(id);
      // If the mutation is successful, show a success notification
      notification.success({
        message: "Đã xoá đơn hàng thành công",
        description: `Đơn hàng số ${id} đã được xoá thành công.`,
      });
    } catch (error) {
      // If there is an error, show an error notification
      notification.error({
        message: "Xoá đơn hàng thất bại",
        description: `Đã xảy ra lỗi khi xoá đơn hàng số ${id}.`,
      });
    }
  };
  return (
    <div className="max-w-4xl mx-auto">
      <div className="flex justify-between items-center mb-4">
        <h2 className="font-bold text-2xl">Quản lý liên hệ</h2>
      </div>

      <Table
        dataSource={dataSource}
        columns={columns}
        pagination={{ pageSize: 3 }}
      />
    </div>
  );
};

export default BillManagement;
