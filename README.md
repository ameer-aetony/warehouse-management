# 🏭 Warehouse Management System (Laravel)

![Laravel](https://img.shields.io/badge/Laravel-10.x-red?style=flat&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue?style=flat&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?style=flat&logo=mysql)

A modern warehouse management system built with **Laravel 10** using Repository-Service pattern for clean architecture.

## ✨ Features

- 📦 **Inventory Tracking** (Inbound/Outbound)
- 🔢 **Auto-generated Item Codes** (Smart formatting)
- 🔄 **Transaction Reversal System**
- 📊 **Real-time Stock Reports**
- 🔒 **Role-based Access Control**

## 🏗️ Architecture

```mermaid
graph TD
    A[API Controllers] --> B[Services]
    B --> C[Repositories]
    C --> D[Models]
    D --> E[(Database)]
