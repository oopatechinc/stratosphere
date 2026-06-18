# Stage 1: Build
FROM node:24-alpine AS builder
RUN npm i -g pnpm turborepo
WORKDIR /app

# Copy root configurations and workspaces metadata
COPY package.json pnpm-workspace.yaml pnpm-lock.yaml turbo.json ./
# Copy all apps and packages (required for Turborepo / pnpm workspace resolving)
COPY apps ./apps
COPY packages ./packages

# Install dependencies and build specific app using turbo
RUN pnpm install --frozen-lockfile
RUN turbo run build --filter=@stratosphere/admin-dashboard...

# Stage 2: Production runner
FROM node:24-alpine AS runner
WORKDIR /app

# Copy only the built standalone nitro output from your app workspace
COPY --from=builder /app/apps/admin-dashboard/.output ./.output

EXPOSE 3000
ENV NODE_ENV=production
ENV PORT=3000

CMD ["node", ".output/server/index.mjs"]