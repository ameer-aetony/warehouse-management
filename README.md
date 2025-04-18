#  Warehouse Management System Restful-Api


A modern warehouse management system built with **Laravel 12** using Repository-Service pattern for clean architecture.

##  Features

-  **Inventory Tracking** (Inbound/Outbound)
-  **Auto-generated Item Codes** (Smart formatting)
- **Transaction Reversal System**
- **Real-time Stock Reports**


## 🏗️ Architecture

```mermaid
graph TD
    A[API Controllers] --> B[Services]
    B --> C[Repositories]
    C --> D[Models]
    D --> E[(Database)]
