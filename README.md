#  Warehouse Management System Restful-Api


A modern warehouse management system built with **Laravel 12** using Repository-Service pattern for clean architecture.

##  Features

- **Inventory Tracking** (Inbound/Outbound)
- **Auto-generated Item Codes** (Smart formatting)
- **Transaction Reversal System**
- **Real-time Stock Reports**

## Technologies Used
Backend: [Larave,PHP]
Database: [MySQl]


## 🚀 API Documentation

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/YOUR_POSTMAN_ID)
[![Postman Collection](https://img.shields.io/badge/Postman-Collection-orange)]([https://raw.githubusercontent.com/ameer-aetony/warehouse-management/docs/postman_collection.json](https://github.com/ameer-aetony/warehouse-management/blob/main/Docs/warehouse_management.postman_collection.json))

### Direct Links
- [Download Collection](docs/postman_collection.json)
- [View in GitHub](docs/postman_collection.json)

## 🏗️ Architecture

```mermaid
graph TD
    A[API Controllers] --> B[Services]
    B --> C[Repositories]
    C --> D[Models]
    D --> E[(Database)]


