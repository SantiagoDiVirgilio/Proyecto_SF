const publicKey = "APP_USR-226856e1-5fbf-4b6b-9534-a5dbeef03d2b";
const mp = new MercadoPago(publicKey);
const bricksBuilder = mp.bricks();

const renderWalletBrick = async (preferenceId) => {
  await bricksBuilder.create("wallet", "walletBrick_container", {
    initialization: {
      preferenceId: preferenceId,
    }
  });
};
