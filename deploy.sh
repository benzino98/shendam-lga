#!/bin/bash

# Deployment script for Shendam LGA Production Server
# This script handles the deployment process on the production server

set -e  # Exit on any error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration
DEPLOY_PATH="${DEPLOY_PATH:-/home/shendam/public_html}"
DEPLOY_USER="${DEPLOY_USER:-shendam}"
BACKUP_DIR="${DEPLOY_PATH}/backups"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)

echo -e "${GREEN}Starting deployment...${NC}"

# Create backup directory if it doesn't exist
mkdir -p "$BACKUP_DIR"

# Step 1: Backup current deployment
echo -e "${YELLOW}Step 1: Creating backup...${NC}"
if [ -d "$DEPLOY_PATH" ]; then
    tar -czf "${BACKUP_DIR}/backup_${TIMESTAMP}.tar.gz" -C "$DEPLOY_PATH" \
        --exclude='storage/logs/*' \
        --exclude='storage/framework/cache/*' \
        --exclude='storage/framework/sessions/*' \
        --exclude='storage/framework/views/*' \
        .
    echo -e "${GREEN}Backup created: backup_${TIMESTAMP}.tar.gz${NC}"
fi

# Step 2: Extract new deployment
echo -e "${YELLOW}Step 2: Extracting new deployment...${NC}"
cd /tmp
if [ -f "deployment.tar.gz" ]; then
    # Create temporary extraction directory
    mkdir -p deployment_temp
    tar -xzf deployment.tar.gz -C deployment_temp
    
    # Step 3: Copy files to deployment path
    echo -e "${YELLOW}Step 3: Copying files to deployment path...${NC}"
    mkdir -p "$DEPLOY_PATH"
    rsync -av --delete \
        --exclude='.env' \
        --exclude='storage' \
        --exclude='bootstrap/cache' \
        deployment_temp/ "$DEPLOY_PATH/"
    
    # Step 4: Preserve or create .env file
    if [ -f "$DEPLOY_PATH/.env" ]; then
        echo -e "${GREEN}Preserving existing .env file${NC}"
    else
        echo -e "${YELLOW}Warning: .env file not found.${NC}"
        if [ -f "deployment_temp/env.production.example" ]; then
            echo -e "${YELLOW}Copying env.production.example as .env template...${NC}"
            cp deployment_temp/env.production.example "$DEPLOY_PATH/.env"
            echo -e "${RED}IMPORTANT: Please update $DEPLOY_PATH/.env with your production values and run: php artisan key:generate${NC}"
        else
            echo -e "${RED}Error: .env file not found and no template available. Please create it manually.${NC}"
        fi
    fi
    
    # Step 5: Set proper permissions
    echo -e "${YELLOW}Step 4: Setting permissions...${NC}"
    chown -R "$DEPLOY_USER:$DEPLOY_USER" "$DEPLOY_PATH"
    chmod -R 755 "$DEPLOY_PATH"
    chmod -R 775 "$DEPLOY_PATH/storage"
    chmod -R 775 "$DEPLOY_PATH/bootstrap/cache"
    
    # Step 6: Install/Update Composer dependencies
    echo -e "${YELLOW}Step 5: Installing Composer dependencies...${NC}"
    cd "$DEPLOY_PATH"
    composer install --no-interaction --prefer-dist --no-dev --optimize-autoloader
    
    # Step 7: Run Laravel deployment commands
    echo -e "${YELLOW}Step 6: Running Laravel deployment commands...${NC}"
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
    
    # Step 8: Run database migrations
    echo -e "${YELLOW}Step 7: Running database migrations...${NC}"
    php artisan migrate --force
    
    # Step 9: Clear and cache
    echo -e "${YELLOW}Step 8: Clearing and caching...${NC}"
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    php artisan view:clear
    
    # Rebuild cache
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    
    # Step 10: Restart services (if using systemd)
    echo -e "${YELLOW}Step 9: Restarting services...${NC}"
    if systemctl is-active --quiet apache2 2>/dev/null; then
        systemctl reload apache2
    fi
    
    # Cleanup
    echo -e "${YELLOW}Step 10: Cleaning up...${NC}"
    rm -rf /tmp/deployment_temp
    rm -f /tmp/deployment.tar.gz
    
    echo -e "${GREEN}Deployment completed successfully!${NC}"
    echo -e "${GREEN}Backup saved at: ${BACKUP_DIR}/backup_${TIMESTAMP}.tar.gz${NC}"
else
    echo -e "${RED}Error: deployment.tar.gz not found${NC}"
    exit 1
fi
