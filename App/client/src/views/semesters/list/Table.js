// ** React Imports
import { Fragment, useState, useEffect } from 'react'

// ** Semester List Sidebar
import Sidebar from './Sidebar'
import Avatar from '@components/avatar'
// ** Columns
import { columns } from './columns'

// ** Store & Actions
import { getAllData, getData, restoreSemester } from '../store/action'
import { useDispatch, useSelector } from 'react-redux'

// ** Third Party Components
import ReactPaginate from 'react-paginate'
import { ChevronDown, Check } from 'react-feather'
import DataTable from 'react-data-table-component'
import { Card, Input, Row, Col, Label, CustomInput, Button } from 'reactstrap'

// ** Styles
import '@styles/react/libs/react-select/_react-select.scss'
import '@styles/react/libs/tables/react-dataTable-component.scss'
import { store } from '@store/storeConfig/store'

// ** ErrorToast Component for Undo Records
export const ErrorToast = ({ id }) => (
  <Fragment>
    <div className="toastify-header">
      <div className="title-wrapper">
        <Avatar size="sm" color="success" icon={<Check size={12} />} />
        <h6 className="toast-title">Success</h6>
      </div>
      <small className="text-muted">3 secondes Ago</small>
    </div>
    <div className="toastify-body alert-danger">
      <span role="img" aria-label="toast-text">
        Record deleted <strong>Oops</strong>{' '}
        <Button.Ripple
          color="flat-info"
          onClick={() => {
            store.dispatch(restoreSemester(id))
          }}
        >
          Undo
        </Button.Ripple>
      </span>
    </div>
  </Fragment>
)

// ** Table Header
const CustomHeader = ({
  toggleSidebar,
  handlePerPage,
  rowsPerPage,
  handleFilter,
  searchTerm
}) => {
  return (
    <div className="invoice-list-table-header w-100 mr-1 ml-50 mt-2 mb-75">
      <Row>
        <Col xl="6" className="d-flex align-items-center p-0">
          <div className="d-flex align-items-center w-100">
            <Label for="rows-per-page">Show</Label>
            <CustomInput
              className="form-control mx-50"
              type="select"
              id="rows-per-page"
              value={rowsPerPage}
              onChange={handlePerPage}
              style={{
                width: '5rem',
                padding: '0 0.8rem',
                backgroundPosition:
                  'calc(100% - 3px) 11px, calc(100% - 20px) 13px, 100% 0'
              }}
            >
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
            </CustomInput>
            <Label for="rows-per-page">Entries</Label>
          </div>
        </Col>
        <Col
          xl="6"
          className="d-flex align-items-sm-center justify-content-lg-end justify-content-start flex-lg-nowrap flex-wrap flex-sm-row flex-column pr-lg-1 p-0 mt-lg-0 mt-1"
        >
          <div className="d-flex align-items-center mb-sm-0 mb-1 mr-1">
            <Label className="mb-0" for="search-invoice">
              Search:
            </Label>
            <Input
              id="search-invoice"
              className="ml-50 w-100"
              type="text"
              value={searchTerm}
              onChange={e => handleFilter(e.target.value)}
            />
          </div>
          <Button.Ripple color="primary" onClick={toggleSidebar}>
            Add New Semester
          </Button.Ripple>
        </Col>
      </Row>
    </div>
  )
}

const SemestersList = () => {
  // ** Store Vars
  const dispatch = useDispatch()
  const { allData } = useSelector(state => state.semesters)
  console.log(allData)
  // ** States
  const [searchTerm, setSearchTerm] = useState('')
  const [currentPage, setCurrentPage] = useState(1)
  const [rowsPerPage, setRowsPerPage] = useState(10)
  const [sidebarOpen, setSidebarOpen] = useState(false)

  useEffect(() => {
    dispatch(getAllData())
  }, [dispatch])

  // ** Function to toggle sidebar
  const toggleSidebar = () => setSidebarOpen(!sidebarOpen)

  // ** Function in get data on search query change
  const handleFilter = val => {
    setSearchTerm(val)
  }
  const filteredData = allData.filter(item => item.name.toLowerCase().includes(searchTerm))

  return (
    <Fragment>
      <Card>
        <DataTable
          noHeader
          pagination
          subHeader
          responsive
          //paginationServer
          columns={columns}
          sortIcon={<ChevronDown />}
          className="react-dataTable"
          //paginationComponent={CustomPagination}
          data={filteredData}
          subHeaderComponent={
            <CustomHeader
              toggleSidebar={toggleSidebar}
              handlePerPage="10"
              rowsPerPage={rowsPerPage}
              searchTerm={searchTerm}
              handleFilter={handleFilter}
            />
          }
        />
      </Card>

      <Sidebar open={sidebarOpen} toggleSidebar={toggleSidebar} />
    </Fragment>
  )
}

export default SemestersList
