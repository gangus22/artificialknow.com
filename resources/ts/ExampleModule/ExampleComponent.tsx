import React, { memo } from "react";

export const ExampleComponent: React.FC = () => (
    <div className="rounded-lg border border-slate-700 bg-cyan-400 p-4">
        I'm a rendered React component!
    </div>
);

export default memo(ExampleComponent);
