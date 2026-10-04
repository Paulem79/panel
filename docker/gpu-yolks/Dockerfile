# Java yolk with the userspace GPU stack (OpenGL, OpenCL, VA-API, VDPAU) for use with the
# panel's "DRI" GPU passthrough. Build and push it yourself, then point an egg's docker image at it.
#
#   docker build -t myregistry/yolks:java_25_gpu docker/gpu-yolks
#
# For OpenCL on nouveau (Mesa rusticl) set  RUSTICL_ENABLE=nouveau  in the egg's environment.
# For Intel/AMD use  RUSTICL_ENABLE=iris  /  radeonsi  instead.
FROM ghcr.io/pelican-eggs/yolks:java_25

USER root
RUN apt-get update \
 && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
      libgl1-mesa-dri libegl1 libgles2 mesa-utils-bin \
      mesa-opencl-icd ocl-icd-libopencl1 clinfo \
      mesa-va-drivers mesa-vdpau-drivers vainfo vdpauinfo \
      ffmpeg \
 && rm -rf /var/lib/apt/lists/*

# The container user must be able to open /dev/dri nodes; Wings adds the owning groups at runtime.
USER container
ENV USER=container HOME=/home/container
